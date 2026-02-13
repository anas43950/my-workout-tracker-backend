<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkoutHistory extends Model
{
    protected $fillable = [
        'note',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(WorkoutHistoryChild::class);
    }

}
