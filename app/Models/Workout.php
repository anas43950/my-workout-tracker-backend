<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    protected $fillable = [
        'note',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(WorkoutChild::class);
    }

}
