<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'routine_id' => $this->routine_id,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'logs' => WorkoutChildResource::collection($this->whenLoaded('children')),
        ];
    }
}
