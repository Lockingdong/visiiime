<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VUserSubRecord extends Model
{
    use HasFactory;
    use Uuids;

    const US_PAY_INIT = 'INIT';
    const US_PAY_FAIL = 'FAIL';
    const US_PAY_SUCCESS = 'SUCC';

    const US_SUB_INIT = 'INIT';
    const US_SUB_SUCCESS = 'SUCC';
    const US_SUB_TERMINATE = 'TERM';

    protected $fillable = [
        'user_id',
        'sub_id',
        'period_no',
        'mer_order_no',
        'us_name',
        'us_ori_amount',
        'us_amount',
        'us_period_type',
        'us_period',
        'us_sub_status',
        'us_pay_status',
        'us_card_num',
        'us_content',
        'us_start_at',
        'us_end_at',
        'us_next_auth_at'
    ];
}
