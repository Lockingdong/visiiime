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

    protected $fillable = [
        'page_id',
        'user_id',
        'link_status',
        'link_name',
        'link',
        'online',
        'link_type',
        'start_at',
        'end_at',
        'thumbnail',
        'link_custom_data',
        'media_open_type',
        'media_name',
        'collector',
        'item_custom_data',
        'valid',
        'link_order'
    ];
}
