<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;
use App\Traits\UserSubScriptionTrait;

class VUserSubRecord extends Model
{
    use HasFactory;
    use Uuids;
    use UserSubScriptionTrait;

    const US_PAY_INIT = 'INIT';
    const US_PAY_FAIL = 'FAIL';
    const US_PAY_SUCCESS = 'SUCC';
    const US_PAY_WAIT = 'WAIT';

    const US_SUB_INIT = 'INIT';
    const US_SUB_SUCCESS = 'SUCC';
    const US_SUB_TERMINATE = 'TERM';

    const US_START_TYPE_2 = 2; // 檢查卡號模式
    const US_START_TYPE_3 = 3; // 不檢查卡號

    const US_START_AUTH_Y = 'Y';
    const US_START_AUTH_N = 'N';

    protected $fillable = [
        'user_id',
        'sub_id',
        'period_no',
        'mer_order_no',
        'us_name',
        'us_ori_amount',
        'us_amount',
        'us_period_type',
        'us_period_start_type',
        'us_period',
        'us_sub_status',
        'us_pay_status',
        'us_card_num',
        'us_content',
        'us_start_at',
        'us_end_at',
        'us_next_auth_at',
        'us_start_auth',
        'us_status',
    ];

}
