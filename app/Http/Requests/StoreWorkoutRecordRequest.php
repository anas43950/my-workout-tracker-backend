<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkoutRecordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'workout_id' => ['required', 'exists:workouts,id'],
            'sets' => ['required', 'array'],
            'sets.*.reps' => ['required', 'integer'],
            'sets.*.weight' => ['required', 'integer'],
            'sets.*.is_drop_set' => ['sometimes', 'boolean:strict'],
        ];
    }
}
