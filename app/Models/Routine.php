<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
}
