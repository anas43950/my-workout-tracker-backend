<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutHistoryChildResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'workout' => new WorkoutResource($this->whenLoaded('workout')),
            'sets' => WorkoutHistorySetResource::collection($this->whenLoaded('sets'))
        ];
    }
}
