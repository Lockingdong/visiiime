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
    const AVAL = 'AVAL';

    protected $fillable = [
        'user_id',
        'theme_id',
        'page_status',
        'page_url'
    ];
}
