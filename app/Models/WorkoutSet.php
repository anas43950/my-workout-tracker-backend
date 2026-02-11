<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutSet extends Model
{
 protected $fillable = [
        'reps',
        'weight',
        'drop_set_reps',
        'drop_set_weight',
    ];
}
