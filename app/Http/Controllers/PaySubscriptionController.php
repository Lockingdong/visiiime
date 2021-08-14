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

    public function subscriptionPage()
    {
        $action = route('subscription.pay');

        return view('components.subscription.product', compact(
            'action'
        ));
    }

    public function paySubscription()
    {

        try {
            DB::beginTransaction();

            $snowflake = new Snowflake;
            $merOrderNo = 'V' . $snowflake->id();
            // dd($merOrderNo);
            // create user subscription
            $vUserSubscription = new VUserSubscription([
                'user_id' => auth()->user()->id,
                'sub_id' => '12345',
                'mer_order_no' => $merOrderNo,
                'us_name' => '測試訂閱',
                'us_ori_amount' => 100,
                'us_amount' => 100,
                'us_period_type' => 'D',
                'us_period' => 30,
                'us_status' => VUserSubscription::US_INIT,
                'us_card_num' => '',
                'us_content' => '測試訂閱內容',
                'us_start_at' => Carbon::now()->startOfDay(),
            ]);

            $this->vUserSubscriptionService->create($vUserSubscription);

            // 傳送至藍新
            $newebPay = NewebPay::period(
                $merOrderNo,        //訂單編號
                159,       //訂單金額
                '測試訂閱',      //產品名稱
                'D',      //週期類別 (D, W, M, Y)
                30,     //交易週期授權時間
                2, //檢查卡號模式
                12,     //授權期數
                auth()->user()->email      //連絡信箱
            )
            ->setPeriodNotifyURL('https://aed54951623c.ngrok.io/api/v1/v-subscription/period/callback')
            ->setOrderInfo('N');

            DB::commit();

            return $newebPay->submit();
        } catch (Throwable $th) {

            Log::error($th->getMessage());

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
            $this->vSubAuthDataService->create($vSubAuthData);

            // 接回的參數為成功
            // 1. 找到userSubscription
            Log::info($vSubAuthData->merchant_order_no);
            $vUserSubscription = $this->vUserSubscriptionService->findBy('mer_order_no', $vSubAuthData->merchant_order_no);

            // 2. 紀錄 userSubRecord
            $vUserSubRecord = new VUserSubRecord([
                'user_id' => $vUserSubscription->id,
                'sub_id' => $vUserSubscription->sub_id,
                'period_no' => $vUserSubscription->period_no,
                'mer_order_no' => $vUserSubscription->mer_order_no,
                'usr_name' => $vUserSubscription->us_name,
                'usr_ori_amount' => $vUserSubscription->us_ori_amount,
                'usr_amount' => $vUserSubscription->us_amount,
                'usr_period_type' => $vUserSubscription->us_period_type,
                'usr_period' => $vUserSubscription->us_period,
                'usr_status' => $vUserSubscription->us_status,
                'usr_card_num' => $vUserSubscription->us_card_num,
                'usr_content' => $vUserSubscription->us_content,
                'usr_start_at' => $vUserSubscription->us_start_at,
                'usr_end_at' => $vUserSubscription->us_end_at,
                'usr_next_auth_at' => $vUserSubscription->us_next_auth_at,
            ]);
            $this->vUserSubRecordService->create($vUserSubRecord);

            // 3. 更新 userSubscription
            $usStatus = ($vSubAuthData->status === 'SUCCESS') ? VUserSubscription::US_SUCCESS : VUserSubscription::US_STOP;
            $this->vUserSubscriptionService->update($vUserSubscription->id, [
                'us_status' => $usStatus,
                'us_card_num' => $vSubAuthData->card_no,
                'us_end_at' => $vSubAuthData->getAuthDateArr()[1] ?? null,
                'us_next_auth_at' => $vSubAuthData->getAuthDateArr()[1] ?? null,
                'period_no' => $vSubAuthData->period_no,
            ]);

            // 3. 升級會員 or 終止扣款
            if($usStatus === VUserSubscription::US_SUCCESS) {
                $this->userService->updateUserRole(
                    $vUserSubscription->user_id,
                    VRolePermission::VVIP
                );
            } else {
                // todo ...
                // 終止續扣
                NewebPay::alterStatus(
                    $vUserSubscription->mer_order_no, //訂單編號
                    $vUserSubscription->period_no, //委託編號
                    self::PERIOD_TERMINATE

                )->submitAndDecode('period');
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
