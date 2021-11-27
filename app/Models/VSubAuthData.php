<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VSubAuthData extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'status',
        'message',
        'merchant_id',
        'merchant_order_no',
        'order_no',
        'period_type',
        'auth_times',
        'auth_time',
        'date_array',
        'trade_no',
        'card_no',
        'period_amt',
        'auth_code',
        'respond_code',
        'escrow_bank',
        'auth_bank',
        'auth_date',
        'next_auth_date',
        'total_times',
        'already_times',
        'payment_method',
        'period_no',
        'extday',
        'new_next_time',
        'raw_data',
    ];

    public function getAuthDateArr()
    {
        if($this->date_array !== null) {
            return explode(',', $this->date_array);
        }

        return [];
    }
}
