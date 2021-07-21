<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VPage extends Model
{
    use HasFactory;
    use Uuids;

    // page_status
    const AVAILABLE = 'AVAL';
    const UNCOMPLETED = 'UNCO';
    const DISABLED = 'DISA';

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
        'social_links',
        'layout_code'
    ];

    public function visit()
    {
        return visits($this);
    }
}
