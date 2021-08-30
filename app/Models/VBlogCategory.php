<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VBlogCategory extends Model
{
    use HasFactory, Uuids;

    const CATE_AVAILABLE = 'AVAL';
    const CATE_DISABLED = 'DISA';

    protected $fillable = [
        'cate_name',
        'cate_status',
        'cate_order'
    ];

}
