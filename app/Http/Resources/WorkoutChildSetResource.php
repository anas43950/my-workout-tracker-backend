<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutChildSetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'reps' => $this->reps,
            'weight' => $this->weight,
            'drop_set_reps' => $this->drop_set_reps,
            'drop_set_weight' => $this->drop_set_weight,
        ];
    }
}
