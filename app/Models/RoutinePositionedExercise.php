<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoutinePositionedExercise extends Model
{
    protected $fillable = [
        'index',
        'exercise_id'
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
