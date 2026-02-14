<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Routine extends Model
{

    protected $fillable = [
        'day',
        'name',
    ];
    public function positionedExercises(): HasMany
    {
        return $this->hasMany(RoutinePositionedExercise::class)->orderBy(('index'));
    }
}
