<?php
namespace App\Traits;
use App\Models\VUserSubscription;
use Illuminate\Support\Carbon;

trait UserSubScriptionTrait
{
    
    public function subStatus()
    {
        switch ($this->us_sub_status) {
            case VUserSubscription::US_SUB_SUCCESS:
                return '訂閱中';
                break;

            case VUserSubscription::US_SUB_TERMINATE:
                return '已終止';
                break;

            case VUserSubscription::US_SUB_INIT:
                return '處理中';
                break;
        }
    }

    public function payStatus()
    {
        switch ($this->us_sub_status) {
            case VUserSubscription::US_PAY_SUCCESS:
                return '已付款';
                break;

            case VUserSubscription::US_PAY_FAIL:
                return '付款失敗';
                break;

            case VUserSubscription::US_PAY_INIT:
                return '待付款';

            case VUserSubscription::US_PAY_WAIT:
                return '待授權';
                break;
        }
    }

    public function nextAuthAt()
    {
        return $this->us_next_auth_at === null ? null : Carbon::createFromFormat('Y-m-d H:i:s', $this->us_next_auth_at)->format('Y/m/d');
    }
}
