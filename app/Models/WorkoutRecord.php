<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutRecord extends Model
{
    protected $fillable = [
        'workout_id',
    ];

    public function sets()
    {
        return $this->hasMany(WorkoutSet::class);
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
}
