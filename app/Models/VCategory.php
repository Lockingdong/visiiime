<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VCategory extends Model
{
    use HasFactory, Uuids;

    const CATE_AVAILABLE = 'AVAL';
    const CATE_DISABLED = 'DISA';

    const CATE_MODEL_TYPES = [
        VPost::class => 'VPost',
        VFaq::class => 'VFaq'
    ];

    protected $fillable = [
        'cate_name',
        'cate_status',
        'cate_order',
        'model_name'
    ];
}
