<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VPageDel extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const DELETED = 'DELE'; // 已刪除

    const PAGE_ONLINE = 1;
    const PAGE_OFFLINE = 0;

    const PAGE_DEFAULT_Y = 'Y';
    const PAGE_DEFAULT_N = 'N';

    protected $fillable = [
        'user_id',
        'theme_id',
        'page_status',
        'page_url',
        'avatar',
        'user_title',
        'description',
        'link_item_order',
        'link_item_order_main',
        'layout_code',
        'custom_data',
        'meta',
        'page_default',
        'online'
    ];
}
