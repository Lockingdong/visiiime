<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VLayout extends Model
{
    use HasFactory, Uuids;

    const AVAILABLE = 'AVAL';
    const DISABLED = 'DISA';

    const THEME_NAME = 'VBasic';

    protected $fillable = [
        'theme_name',
        'layout_display_name',
        'layout_name',
        'layout_code',
        'layout_status',
        'layout_setting',
        'layout_image',
        'layout_order',
    ];
}
