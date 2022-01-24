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

    const LAYOUT_BG_GRADIENT = 'bgGradient';
    const LAYOUT_BG_IMAGE = 'bgImage';
    const LAYOUT_BG_PLAIN = 'bgPlain';

    const THEME_NAME = 'VBasic';

    protected $fillable = [
        'theme_name',
        'layout_type',
        'layout_bg_name',
        'layout_display_name',
        'layout_code',
        'layout_status',
        'layout_role',
        'layout_setting',
        'layout_order',
        'start_at',
        'end_at'
    ];
}
