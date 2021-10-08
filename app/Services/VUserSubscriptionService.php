<?php

namespace App\Services;

use App\Repositories\VUserSubscriptionRepository;
use App\Models\VUserSubscription;
use App\Services\VUserSubRecordService;
use App\Models\VUserSubRecord;
use MingJSHK\NewebPay\Facades\NewebPay;
use Godruoyi\Snowflake\Snowflake;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;


class VUserSubscriptionService extends BaseService
{

    const PERIOD_SUSPEND = 'suspend';
    const PERIOD_TERMINATE = 'terminate';
    const PERIOD_RESTART = 'restart';

    protected $vUserSubscriptionRepository;
    protected $vUserSubRecordRepository;

    protected $vUserSubRecordService;

    public function __construct(
        VUserSubscriptionRepository $vUserSubscriptionRepository,
        VUserSubRecordService $vUserSubRecordService
    )
    {
        parent::__construct($vUserSubscriptionRepository);
        $this->vUserSubscriptionRepository = $vUserSubscriptionRepository;
        $this->vUserSubRecordService = $vUserSubRecordService;
    }


    public function updateUserSubscriptionTerminate(string $id)
    {
        return $this->vUserSubscriptionRepository->update($id, [
            'us_sub_status' => VUserSubscription::US_SUB_TERMINATE
        ]);

        // return NewebPay::alterPeriodStatus(
        //     $merOrderNo,           //訂單編號
        //     $periodNo,             //委託編號
        //     self::PERIOD_TERMINATE // 狀態類別
        // )
        // ->submitAndDecode('period');
    }


    public function createUserSubscription(string $type, ?string $periodStartDate = null)
    {
        
        $price = Config::get('app.premium_' . $type . '_price');

        $snowflake = new Snowflake;
        $snowflakeId = $snowflake->id();
        $subId = 'VIME' . $snowflakeId;
        $merOrderNo = 'V' . $snowflakeId;

        // create user subscription
        $day = ($type === 'year') ? 365 : 30;

        $date = Carbon::now()->startOfDay();

        if($periodStartDate !== null) {
            $date = Carbon::createFromFormat('Y/m/d', $periodStartDate)->startOfDay();
        }

        $uSname = 'Visiiime Premium';
        $content = 'Visiiime Premium ' . $price . '/' . $type;
        $vUserSubscription = new VUserSubscription([
            'user_id' => auth()->user()->id,
            'sub_id' => $subId,
            'mer_order_no' => $merOrderNo,
            'us_name' => $uSname,
            'us_ori_amount' => $price,
            'us_amount' => $price,
            'us_period_type' => 'D',
            'us_period' => $day,
            'us_sub_status' => VUserSubscription::US_SUB_INIT,
            'us_pay_status' => VUserSubscription::US_PAY_INIT,
            'us_card_num' => '',
            'us_content' => $content,
            'us_start_at' => $date,
        ]);

        return $this->vUserSubscriptionRepository->create($vUserSubscription);

    }

    public function updateUserSubscriptionData(string $merOrderNo, array $data)
    {
        return $this->updateUserSubscription($merOrderNo, $data);   
    }

    private function updateUserSubscription(string $merOrderNo, array $data)
    {
        // 紀錄原 subscription
        $vUserSubscription = $this->vUserSubscriptionRepository->findBy('mer_order_no', $merOrderNo);
        $vUserSubRecord = new VUserSubRecord([
            'user_id' => $vUserSubscription->user_id,
            'sub_id' => $vUserSubscription->sub_id,
            'period_no' => $vUserSubscription->period_no,
            'mer_order_no' => $vUserSubscription->mer_order_no,
            'us_name' => $vUserSubscription->us_name,
            'us_ori_amount' => $vUserSubscription->us_ori_amount,
            'us_amount' => $vUserSubscription->us_amount,
            'us_period_type' => $vUserSubscription->us_period_type,
            'us_period' => $vUserSubscription->us_period,
            'us_pay_status' => $vUserSubscription->us_pay_status,
            'us_sub_status' => $vUserSubscription->us_sub_status,
            'us_card_num' => $vUserSubscription->us_card_num,
            'us_content' => $vUserSubscription->us_content,
            'us_start_at' => $vUserSubscription->us_start_at,
            'us_end_at' => $vUserSubscription->us_end_at,
            'us_next_auth_at' => $vUserSubscription->us_next_auth_at,
        ]);
        $this->vUserSubRecordService->create($vUserSubRecord);

        $this->vUserSubscriptionRepository->update($vUserSubscription->id, $data);

        return $vUserSubscription;
    }

    public function findLatestSubscriptionByUserId(string $userId)
    {
        return $this->vUserSubscriptionRepository->findLatestSubscriptionByUserId($userId);
    }
}
