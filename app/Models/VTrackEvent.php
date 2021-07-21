<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VTrackEvent extends Model
{
    use HasFactory, Uuids;

    protected $connection = 'v_tracker';

    protected $fillable = [
        'model_id',
        'model_name',
        'event_type',
        'date',
        'ip',
        'country',
        'city',
        'refer',
        'browser',
        'system',
        'lang',
        'parent_id'
    ];
}
