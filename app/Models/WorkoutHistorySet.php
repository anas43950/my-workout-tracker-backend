<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutHistorySet extends Model
{
    protected $fillable = [
        'reps',
        'weight',
        'drop_set_reps',
        'drop_set_weight',
    ];

    public $timestamps = false;
}
