<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VPost extends Model
{
    use HasFactory, Uuids;

    const POST_AVAILABLE = 'AVAL';
    const POST_DISABLED = 'DISA';

    const POST_TITLE_LENGTH = 30;
    const POST_CONTENT_LENGTH = 90;

    protected $fillable = [
        'user_id',
        'cate_id',
        'post_title',
        'post_content',
        'post_banner',
        'post_order',
        'post_status',
    ];

    /** Relation */
    public function VCategory()
    {
        return $this->belongsTo(VCategory::class, 'cate_id', 'id');
    }

    /** Assessor */
    public function getPostIndexTitleAttribute()
    {
        $title = $this->post_title;
        if (mb_strwidth($title) > self::POST_TITLE_LENGTH) {
            $title = mb_strimwidth($this->post_title, 0, self::POST_TITLE_LENGTH) . '...';
        }
        return $title;
    }

    public function getPostIndexContentAttribute()
    {
        $content = strip_tags($this->post_content);
        if (mb_strwidth($content) > self::POST_CONTENT_LENGTH) {
            $content = mb_strimwidth($content, 0, self::POST_CONTENT_LENGTH) . '...';
        }
        return $content;
    }
}
