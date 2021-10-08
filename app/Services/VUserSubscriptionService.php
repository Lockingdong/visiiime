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
use App\VO\CreateUserSubscriptionVO;
use Illuminate\Support\Facades\App;
use Exception;

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

    public function updateUserSubscriptionPayFail(string $merOrderNo)
    {
        return $this->updateUserSubscription($merOrderNo, [
            'us_pay_status' => VUserSubscription::US_PAY_FAIL
        ]);
    }


    public function updateUserSubscriptionPayWait(string $merOrderNo)
    {
        return $this->updateUserSubscription($merOrderNo, [
            'us_pay_status' => VUserSubscription::US_PAY_WAIT
        ]);
    }


    public function updateUserSubscriptionSubTerminate(string $merOrderNo)
    {
        // todo 打 api 終止
        return $this->updateUserSubscription($merOrderNo, [
            'us_sub_status' => VUserSubscription::US_SUB_TERMINATE
        ]);
    }


    public function createUserSubscription(CreateUserSubscriptionVO $createUserSubscriptionVO)
    {
        // 檢查 vo
        $this->checkUserSubscription($createUserSubscriptionVO);

        $amount = $createUserSubscriptionVO->amount;

        $oriAmount = ($createUserSubscriptionVO->oriAmount === null) ? $amount : $createUserSubscriptionVO->oriAmount;

        $snowflake = new Snowflake;
        $snowflakeId = $snowflake->id();
        $subId = 'VIME' . $snowflakeId;
        $merOrderNo = 'V' . $snowflakeId;

        // create user subscription
        $period = $createUserSubscriptionVO->period;

        $date = Carbon::now()->startOfDay();

        $periodStartType = 2;
        if($createUserSubscriptionVO->periodStartDate !== null) {
            $periodStartType = 3;
            $date = Carbon::createFromFormat('Y/m/d', $createUserSubscriptionVO->periodStartDate)->startOfDay();
        }

        $uSname = 'Visiiime Premium';
        $content = 'Visiiime Premium ' . $amount . '/' . $createUserSubscriptionVO->type;
        $vUserSubscription = new VUserSubscription([
            'user_id' => auth()->user()->id,
            'sub_id' => $subId,
            'mer_order_no' => $merOrderNo,
            'us_name' => $uSname,
            'us_ori_amount' => $oriAmount,
            'us_amount' => $amount,
            'us_period_type' => 'D',
            'us_period_start_type' => $periodStartType,
            'us_period' => $period,
            'us_sub_status' => VUserSubscription::US_SUB_INIT,
            'us_pay_status' => VUserSubscription::US_PAY_INIT,
            'us_card_num' => '',
            'us_content' => $content,
            'us_start_at' => $date,
        ]);

        return $this->vUserSubscriptionRepository->create($vUserSubscription);
    }

    private function checkUserSubscription(CreateUserSubscriptionVO $vo): void
    {
        $allowedPeriodArr = Config::get('app.premium_allowed_period');

        if(App::environment('dev')) {
            $allowedPeriodArr[] = 1; 
            $allowedPeriodArr[] = 2; 
            $allowedPeriodArr[] = 3;         
        }

        $allowedMonthPriceArr = Config::get('app.premium_allowed_month_price');
        $allowedYearPriceArr = Config::get('app.premium_allowed_year_price');

        if(!in_array($vo->period, $allowedPeriodArr)) {
            throw new Exception($vo->period . ' is not allowed');
        }

        if(!in_array($vo->type, ['year', 'month'])) {
            throw new Exception($vo->type . ' is not allowed');
        }

        if($vo->type === 'month') {
            if(!in_array($vo->amount, $allowedMonthPriceArr)) {
                throw new Exception($vo->period . ' is not allowed');
            }

        } else {
            if(!in_array($vo->amount, $allowedYearPriceArr)) {
                throw new Exception($vo->period . ' is not allowed');
            }
        }
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
            'us_status' => $vUserSubscription->us_status,
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
            'us_start_auth' => $vUserSubscription->us_start_auth,
        ]);
        $this->vUserSubRecordService->create($vUserSubRecord);

        $this->vUserSubscriptionRepository->update($vUserSubscription->id, $data);

        return $vUserSubscription;
    }

    public function getLatestPaySuccSubscriptionByUserId(string $userId)
    {
        return $this->vUserSubscriptionRepository->getLatestPaySuccSubscriptionByUserId($userId);
    }

    public function getAllAuthSubscriptionsByUserId(string $userId)
    {
        return $this->vUserSubscriptionRepository->getAllAuthSubscriptionsByUserId($userId);
    }

    public function getLatestNoAuthSubscriptionByUserId(string $userId)
    {
        return $this->vUserSubscriptionRepository->getLatestNoAuthSubscriptionByUserId($userId);
    }
}
