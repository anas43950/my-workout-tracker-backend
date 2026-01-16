<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkoutRecordResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'workout' => new WorkoutResource($this->workout),
            'sets' => WorkoutSetResource::collection($this->sets),
            'created_date' => $this->created_at,
        ];
    }
}
