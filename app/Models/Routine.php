<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Routine extends Model
{

    protected $fillable = [
        'day',      
        'name',
    ];
    public function workouts()
    {
        return $this->belongsToMany(Workout::class);
    }
}
