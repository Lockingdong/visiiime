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
        
        $id = $request->id;
        
        $this->vUserSubscriptionService->updateUserSubscriptionTerminate($id);

        return redirect()->back();
    }

    public function paySubscription(Request $request)
    {

        // todo validate
        try {
            DB::beginTransaction();

            $userId = auth()->user()->id;
            $latestSubscription = $this->vUserSubscriptionService->findLatestSubscriptionByUserId($userId);

            // dd($latestSubscription);
            // 如果最後一筆 subscription 的 pay_status 是 succ, 且 sub_status 是 term 就必須要可以繼續訂閱
            if($latestSubscription !== null && $latestSubscription->us_sub_status === VUserSubscription::US_PAY_SUCCESS) {
                return redirect()->route('dashboard');
            }

            $type = $request->type;
            $periodStartDate = $request->period_start_date;

            $vUserSubscription = $this->vUserSubscriptionService->createUserSubscription($type, $periodStartDate);

            // 傳送至藍新
            $newebPay = NewebPay::period(
                $vUserSubscription->mer_order_no,        //訂單編號
                $vUserSubscription->us_amount,       //訂單金額
                $vUserSubscription->us_name,      //產品名稱
                'D',      //週期類別 (D, W, M, Y)
                $vUserSubscription->us_period,     //交易週期授權時間
                ($periodStartDate === null) ? 2 : 3,      //檢查卡號模式
                ($type === 'year') ? 1 : 12,     //授權期數
                auth()->user()->email      //連絡信箱
            )
            ->setPeriodNotifyURL('https://506e-114-36-210-138.ngrok.io/api/v1/v-subscription/period/callback')
            ->setOrderInfo('N')
            ->setBackURL(route('dashboard'));

            DB::commit();

            return $newebPay->submit();
        } catch (Throwable $th) {

            Log::error($th->getMessage());

            DB::rollBack();
        }
    }

    public function paySubscriptionCallback(Request $request): void
    {

        Log::info('callback');
        try {
            DB::beginTransaction();

            $input = $request->input('Period');
            $decodeInput = NewebPay::decode($input);
            Log::info($decodeInput);
            $data = $this->transformPeriodRequest($decodeInput);

            // 0. 新增回傳的參數
            $vSubAuthData = new VSubAuthData($data);
            $this->vSubAuthDataService->create($vSubAuthData);

            // 接回的參數為成功
            // 1. 找到userSubscription
            Log::info($vSubAuthData->merchant_order_no);

            // 2. 紀錄 userSubRecord

            // 3. 更新 userSubscription
            if($vSubAuthData->card_no !== null) {
                $usPayStatus = ($vSubAuthData->status === 'SUCCESS') ? VUserSubscription::US_PAY_SUCCESS : VUserSubscription::US_PAY_FAIL;
                $usSubStatus = ($vSubAuthData->status === 'SUCCESS') ? VUserSubscription::US_SUB_SUCCESS : VUserSubscription::US_SUB_TERMINATE;
            } else { // 沒卡號表示未授權
                $usPayStatus = VUserSubscription::US_PAY_INIT;
                $usSubStatus = VUserSubscription::US_PAY_INIT;
            }

            $nextAuthDate = ($vSubAuthData->date_array !== null) ? $vSubAuthData->getAuthDateArr()[1] : $vSubAuthData->next_auth_date;

            $vUserSubscription = $this->vUserSubscriptionService->updateUserSubscriptionData($vSubAuthData->merchant_order_no, [
                'us_pay_status' => $usPayStatus,
                'us_sub_status' => $usSubStatus,
                'us_card_num' => $vSubAuthData->card_no,
                'us_end_at' => $nextAuthDate,
                'us_next_auth_at' => $nextAuthDate,
                'period_no' => $vSubAuthData->period_no,
            ]);

            // 4. 升級會員 or 終止扣款
            if($usPayStatus === VUserSubscription::US_PAY_SUCCESS) {
                $this->userService->updateUserRole(
                    $vUserSubscription->user_id,
                    VRolePermission::VVIP
                );
            } else {
                // todo 降級...
                // 終止續扣
            }

            DB::commit();
        } catch (Throwable $th) {
            //throw $th;
            Log::error($th->getMessage());

            DB::rollBack();
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
