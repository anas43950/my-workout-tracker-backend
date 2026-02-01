<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateWorkoutRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('workouts', 'id')],
            'name' => [
                Rule::unique('workouts')
                    ->where(
                        fn($query) =>
                        $query
                            ->where('user_id', $this->user()->id)
                            ->where('id', '!=', $this->id)
                    ),
            ],
            'sets' => ['integer'],
            'rep_range_from' => ['integer'],
            'rep_range_to' => ['integer'],
        ];
    }
}
