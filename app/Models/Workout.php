<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    protected $fillable = [
        'note',
        'routine_id',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(WorkoutChild::class);
    }

}
