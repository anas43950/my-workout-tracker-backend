<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutHistoryChild extends Model
{
    protected $fillable = [
        'workout_id',
    ];

    public function sets()
    {
        return $this->hasMany(WorkoutHistorySet::class);
    }
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
