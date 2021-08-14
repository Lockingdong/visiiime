<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VUserSubscription extends Model
{
    use HasFactory;
    use Uuids;

    const US_INIT = 'INIT';
    const US_CANCEL = 'CNCL';
    const US_SUCCESS = 'SUCC';
    const US_STOP = 'STOP';

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
        'us_status',
        'us_card_num',
        'us_content',
        'us_start_at',
        'us_end_at',
        'us_next_auth_at',
    ];
}
