<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Log;
use Throwable;
use App\Models\VUserSubscription;
use App\Models\VUserSubRecord;
use App\Models\VSubAuthData;
use App\Services\VUserSubscriptionService;
use App\Services\VUserSubRecordService;
use App\Services\VSubAuthDataService;
use App\Services\UserService;
use App\Enum\VRolePermission;
use Illuminate\Support\Carbon;
use MingJSHK\NewebPay\Facades\NewebPay;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Support\Facades\Config;
use App\VO\CreateUserSubscriptionVO;
use Exception;
use Illuminate\Support\Facades\App;

class PaySubscriptionController extends Controller
{

    const PERIOD_SUSPEND = 'suspend';
    const PERIOD_TERMINATE = 'terminate';
    const PERIOD_RESTART = 'restart';

    protected $vUserSubscriptionService;
    protected $vUserSubRecordService;
    protected $vSubAuthDataService;
    protected $userService;

    public function __construct(
        VUserSubscriptionService $vUserSubscriptionService,
        VUserSubRecordService $vUserSubRecordService,
        VSubAuthDataService $vSubAuthDataService,
        UserService $userService
    )
    {
        $this->vUserSubscriptionService = $vUserSubscriptionService;
        $this->vUserSubRecordService = $vUserSubRecordService;
        $this->vSubAuthDataService = $vSubAuthDataService;
        $this->userService = $userService;
    }

    // public function subscriptionPage()
    // {
    //     $action = route('subscription.pay');

    //     return view('components.subscription.product', compact(
    //         'action'
    //     ));
    // }

    public function terminateSubscription(Request $request)
    {
        try {

            $merOrderNo = $request->mer_order_no;
        
            $this->vUserSubscriptionService->updateUserSubscriptionSubTerminate($merOrderNo);

            return redirect()->back();

        } catch (\Throwable $th) {

            // todo handle errors
            return redirect()->back();
        }
    }

    public function paySubscription(Request $request)
    {

        // todo validate
        try {
            DB::beginTransaction();

            $userId = auth()->user()->id;

            // 防止重複訂閱
            $latestSubscription = $this->vUserSubscriptionService->getLatestPaySuccSubscriptionByUserId($userId);
            if($latestSubscription !== null && $latestSubscription->us_sub_status !== VUserSubscription::US_SUB_TERMINATE) {
                return redirect()->route('dashboard');
            }

            $type = $request->type;
            $amount = $request->amount;
            $oriAmount = $request->ori_amount;
            $periodStartDate = $request->period_start_date;
            $period = $request->period;

            // 準備 createUserSubscriptionVO;
            $cusVo = new CreateUserSubscriptionVO;
            $cusVo->type = $type;
            $cusVo->amount = $amount;
            $cusVo->oriAmount = $oriAmount;
            $cusVo->periodStartDate = $periodStartDate;
            $cusVo->period = $period;

            $vUserSubscription = $this->vUserSubscriptionService->createUserSubscription($cusVo);
            // 傳送至藍新
            $newebPay = NewebPay::period(
                $vUserSubscription->mer_order_no,          //訂單編號
                $vUserSubscription->us_amount,             //訂單金額
                $vUserSubscription->us_name,               //產品名稱
                'D',                                       //週期類別 (D, W, M, Y)
                $vUserSubscription->us_period,             //交易週期授權時間
                $vUserSubscription->us_period_start_type,  //檢查卡號模式
                ($type === 'year') ? 1 : 12,               //授權期數
                auth()->user()->email                      //連絡信箱
            )
            ->setOrderInfo('N')
            ->setBackURL(route('dashboard'));

            DB::commit();

            return $newebPay->submit();
        } catch (Throwable $th) {

            Log::error($th->getMessage());

            return $th->getMessage();

            DB::rollBack();
        }
    }

    public function paySubscriptionCallback(Request $request): void
    {

        try {
            DB::beginTransaction();

            $input = $request->input('Period');
            $decodeInput = NewebPay::decode($input);
            Log::info($decodeInput);
            $data = $this->transformPeriodRequest($decodeInput);

            // 0. 新增回傳的參數
            $vSubAuthData = new VSubAuthData($data);
            $vSubAuthData->raw_data = json_encode($data);
            $this->vSubAuthDataService->create($vSubAuthData);

            // 接回的參數為成功
            // 1. 找到userSubscription
            Log::info($vSubAuthData->merchant_order_no);

            // 防止dev更新已終止的訂閱
            $this->preventDevEnvRenew($vSubAuthData->merchant_order_no);

            // 3. 更新 userSubscription
            if($vSubAuthData->auth_code !== null) {
                $usPayStatus = ($vSubAuthData->status === 'SUCCESS') ? VUserSubscription::US_PAY_SUCCESS : VUserSubscription::US_PAY_FAIL;
                $usSubStatus = ($vSubAuthData->status === 'SUCCESS') ? VUserSubscription::US_SUB_SUCCESS : VUserSubscription::US_SUB_TERMINATE;
            } else {
                $usPayStatus = VUserSubscription::US_PAY_INIT;
                $usSubStatus = VUserSubscription::US_SUB_INIT;
            }
            
            $nextAuthDate = ($vSubAuthData->date_array !== null) ? $vSubAuthData->getAuthDateArr()[1] : $vSubAuthData->next_auth_date;

            $vUserSubscription = $this->vUserSubscriptionService->updateUserSubscriptionData($vSubAuthData->merchant_order_no, [
                'us_status' => $vSubAuthData->status,
                'us_pay_status' => $usPayStatus,
                'us_sub_status' => $usSubStatus,
                'us_card_num' => $vSubAuthData->card_no,
                'us_end_at' => $nextAuthDate,
                'us_next_auth_at' => $nextAuthDate,
                'period_no' => $vSubAuthData->period_no,
                'us_start_auth' => ($vSubAuthData->auth_code !== null) ? VUserSubscription::US_START_AUTH_Y : VUserSubscription::US_START_AUTH_N,
            ]);

            // 4. 升級會員 or 終止扣款
            // 有授權和無授權走不同流程
            if($vSubAuthData->auth_code !== null) {
                if($usPayStatus === VUserSubscription::US_PAY_SUCCESS) {
                    $this->userService->updateUserRole(
                        $vUserSubscription->user_id,
                        VRolePermission::VVIP
                    );
                } else {
                    // todo 降級...
                    // 終止續扣
                    $this->vUserSubscriptionService->updateUserSubscriptionSubTerminate($vSubAuthData->merchant_order_no);
                }
            } else { // 無授權

                if($vSubAuthData->status === 'SUCCESS') {
                    $this->vUserSubscriptionService->updateUserSubscriptionPayWait($vSubAuthData->merchant_order_no);
                } else {
                    $this->vUserSubscriptionService->updateUserSubscriptionPayFail($vSubAuthData->merchant_order_no);
                }

            }

            DB::commit();
        } catch (Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            DB::rollBack();
        }
    }

    private function preventDevEnvRenew(string $merOrderNo): void
    {
        if (App::environment('dev')) {

            $vUserSubscription = $this->vUserSubscriptionService->findBy('mer_order_no', $merOrderNo);

            if($vUserSubscription->us_sub_status === VUserSubscription::US_SUB_TERMINATE) {
                throw new Exception($merOrderNo . " can not renew subscription in 'dev' if sub_status is 'TERM'");
            }
        }
    }

    private function transformPeriodRequest(array $data): array
    {
        $transformedData = $data['Result'];
        $transformedData['Status'] = $data['Status'];
        $transformedData['Message'] = $data['Message'];

        $transformedDataNew = [];
        foreach($transformedData as $k => $value) {
            $transformedDataNew[$this->underscoreTransformer($k)] = $value;
        }
        return $transformedDataNew;
    }

    private function underscoreTransformer(string $input): string
    {
        $pattern = '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!';
        preg_match_all($pattern, $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
          $match = $match == strtoupper($match) ?
                strtolower($match) :
              lcfirst($match);
        }
        return implode('_', $ret);
    }

}
