<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Workout extends Model
{
    protected $fillable = [
        'note',
        'routine_id',
        'started_at',
    ];

    public function children(): HasMany
    {
        return $this->hasMany(WorkoutChild::class);
    }

    protected function startedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value  ? Carbon::parse($value)->toISOString() : null
        );
    }
}
