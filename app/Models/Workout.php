<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{

    protected $fillable = [
        'name',
    ];
    public function workoutRecords()
    {
        return $this->hasMany(WorkoutRecord::class);
    }

    public function sets()
    {
        return $this->hasMany(WorkoutSet::class);
    }
}
