<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{

    protected $fillable = [
        'name',
        'sets',
        'rep_range_from',
        'rep_range_to',
    ];
    public function workouts()
    {
        return $this->hasMany(WorkoutChild::class);
    }
}
