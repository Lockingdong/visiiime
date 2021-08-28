<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class VPost extends Model
{
    use HasFactory, Uuids;

    protected $fillable = ['title', 'content', 'banner'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photes()
    {
        return $this->hasMany(VPostPhote::class);
    }

    public function tags()
    {
        return$this->morphMany(VTag::class, 'taggable');
    }
}
