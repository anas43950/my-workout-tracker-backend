<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{

    protected $fillable = [
        'name',
        'sets',
        'rep_range_from',
        'rep_range_to',
    ];
    public function history()
    {
        return $this->hasMany(WorkoutHistoryChild::class);
    }
}
