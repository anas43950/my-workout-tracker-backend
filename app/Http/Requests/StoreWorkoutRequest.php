<?php

namespace App\Http\Requests;

use App\Constants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'note' => ['sometimes'],
            'routine_id' => [
                'required', 
                Rule::exists('routines', 'id')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    )
                ],
            'logs.*.exercise_id' => ['required', 'exists:exercises,id'],
            'logs.*.sets' => ['required', 'array'],
            'logs.*.sets.*.reps' => ['required', 'integer'],
            'logs.*.sets.*.weight' => ['required', 'numeric'],
            'logs.*.sets.*.drop_set_reps' => ['required_with:logs.*.sets.*.drop_set_weight', 'integer'],
            'logs.*.sets.*.drop_set_weight' => ['required_with:logs.*.sets.*.drop_set_reps', 'numeric'],
        ];

        return $rules;
    }
}
