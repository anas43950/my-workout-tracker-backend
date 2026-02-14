<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'exercise_id' => $this->whenLoaded('exercise', function(){
                return $this->exercise->id;
            }),
            'exercise_name' => $this->whenLoaded('exercise', function(){
                return $this->exercise->name;
            }),
            'sets' => WorkoutChildSetResource::collection($this->whenLoaded('sets'))
        ];
    }
}
