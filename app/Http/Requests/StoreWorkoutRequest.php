<?php

namespace App\Http\Requests;

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
        return [
            'name' => [
                'required',
                Rule::unique('workouts')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    ),
            ],
            'sets' => ['required', 'integer'],
            'rep_range_from' => ['required', 'integer'],
            'rep_range_to' => ['required', 'integer'],
        ];
    }

}
