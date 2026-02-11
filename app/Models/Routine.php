<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Routine extends Model
{

    protected $fillable = [
        'day',
        'name',
    ];
    public function positionedWorkouts()
    {
        return $this->hasMany(RoutinePositionedWorkout::class);
    }
}
