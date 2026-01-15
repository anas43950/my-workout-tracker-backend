<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoutineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'day' => [
                'required',
                'string',
                Rule::in(Constants::WEEKDAYS),
                Rule::unique('routines')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    ),
            ],
            'workouts_ids' => [
                'required',
                'array'
            ],
            'workouts_ids.*' => [
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

    public function messages()
    {
        return [
            'day.required' => 'Please select a day for this routine',
            'day.unique' => 'Routine already added for this day',
            'workouts_ids.required' => 'Please select workouts for this routine',
            'workouts_ids.*.integer' => 'Every workout ID must be an integer',
            'workouts_ids.*.exists' => 'No workout found for the given workout ID'
        ];
    }
}
