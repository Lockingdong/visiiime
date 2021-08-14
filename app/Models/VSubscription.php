<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VSubscription extends Model
{
    use HasFactory;
    use Uuids;

    protected $fillable = [
        'sub_name',
        'sub_amount',
        'sub_ori_amount',
        'sub_period',
        'sub_period_type',
        'sub_status',
        'sub_image',
        'sub_content',
    ];
}
