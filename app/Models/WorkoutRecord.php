<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutRecord extends Model
{

    public function sets()
    {
        return $this->hasMany(WorkoutSet::class);
    }
}
