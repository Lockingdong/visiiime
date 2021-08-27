<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class VFile extends Model
{
    use HasFactory, Uuids;

    const FILE_IMAGE = 'IMAGE';

    protected $fillable = [
        'model_id',
        'model_name',
        'field_name',
        'file_path',
        'file_type',
    ];
}
