<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VUserSubRecord extends Model
{
    use HasFactory;
    use Uuids;

    const USR_INIT = 'INIT';
    const USR_CANCEL = 'CNCL';
    const USR_SUCCESS = 'SUCC';
    const USR_STOP = 'STOP';

    protected $fillable = [
        'user_id',
        'sub_id',
        'period_no',
        'mer_order_no',
        'usr_name',
        'usr_ori_amount',
        'usr_amount',
        'usr_period_type',
        'usr_period',
        'usr_status',
        'usr_card_num',
        'usr_content',
        'usr_start_at',
        'usr_end_at',
        'usr_next_auth_at'
    ];
}
