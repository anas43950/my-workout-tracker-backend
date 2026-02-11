<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model
{
 protected $fillable = [
        'reps',
        'weight',
        'is_drop_set',
    ];
}
