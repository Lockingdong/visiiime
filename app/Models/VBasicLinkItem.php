<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VBasicLinkItem extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const AVAILABLE = 'AVAL';
    const DISABLED = 'DISA';

    const LINK_AREA_NORMAL = 'normal';
    const LINK_AREA_MAIN = 'main';
    const LINK_AREA_SOCIAL = 'social';

    const LINK_IMG_MODE_BIG = 'BIG';

    const LINK_COL_MODE_50 = '50';

    protected $fillable = [
        'page_id',
        'user_id',
        'link_status',
        'link_name',
        'link',
        'online',
        'link_type',
        'link_area',
        'start_at',
        'end_at',
        'thumbnail',
        'link_custom_data',
        'media_open_type',
        'media_name',
        'collector',
        'item_custom_data',
        'valid',
        'link_order',
        'link_img_mode',
        'link_col_mode',
        'link_pwd'
    ];
}
