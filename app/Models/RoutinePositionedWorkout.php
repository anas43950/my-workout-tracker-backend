<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutinePositionedWorkout extends Model
{
    protected $fillable = [
        'index',
        'workout_id'
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
