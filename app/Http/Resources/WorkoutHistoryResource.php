<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'note' => $this->note,
            'created_date' => $this->created_at,
            'logs' => WorkoutHistoryChildResource::collection($this->whenLoaded('children')),
        ];
    }
}
