<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class VTrackEvent extends Model
{
    use HasFactory, Uuids;

    protected $connection = 'v_tracker';
    protected $collection = 'v_track_events'; 
    protected $primaryKey = '_id'; 

    protected $fillable = [
        'model_id',
        'model_name',
        'event_type',
        'ip',
        'country',
        'iso_code',
        'city',
        'refer',
        'browser',
        'system',
        'lang',
        'model_parent_id',
        'device'
    ];
}
