<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VTheme extends Model
{
    use HasFactory;
    use Uuids;

    const VBasic = 'VBasic';
}
