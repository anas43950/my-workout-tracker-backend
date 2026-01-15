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
}
