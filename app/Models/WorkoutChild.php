<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutChild extends Model
{
    protected $fillable = [
        'exercise_id',
    ];

    public function sets()
    {
        return $this->hasMany(WorkoutChildSet::class);
    }
    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
