<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VFaq extends Model
{
    use HasFactory, Uuids;

    const FAQ_AVAILABLE = 'AVAL';
    const FAQ_DISABLED = 'DISA';

    protected $fillable = [
        'user_id',
        'cate_id',
        'faq_title',
        'faq_content',
        'faq_order',
        'faq_status',
    ];

    public function VCategory()
    {
        return $this->belongsTo(VCategory::class, 'cate_id', 'id');
    }
}
