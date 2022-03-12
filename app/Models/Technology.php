<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TechnologyModel extends Model
{
    use HasFactory;

    const BRUNCH_LEFT_CODE = 1;
    const BRUNCH_RIGHT_CODE = 2;
    const BRUNCH_STOP_CODE = 1;
}
