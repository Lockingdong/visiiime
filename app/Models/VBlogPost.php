<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VBlogPost extends Model
{
    use HasFactory, Uuids;

    const POST_AVAILABLE = 'AVAL';
    const POST_DISABLED = 'DISA';

    protected $fillable = [
        'user_id',
        'cate_id',
        'post_title',
        'post_content',
        'post_banner',
        'post_order',
        'post_status',
    ];

}
