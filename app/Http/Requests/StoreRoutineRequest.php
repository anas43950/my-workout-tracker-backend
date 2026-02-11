<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoutineRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => [
                'required',
                'string',
                Rule::unique('routines')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    )
            ],
            'positioned_workouts_ids' => [
                'required',
                'array'
            ],
            'positioned_workouts_ids.*' => [
                'array',
            ],
            'positioned_workouts_ids.*.index' => [
                'required',
                'integer',
                'distinct',
            ],
            'positioned_workouts_ids.*.workout_id' => [
                'required',
                'integer',
                Rule::exists('workouts', 'id')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    )
            ]
        ];
        return $rules;
    }
}
