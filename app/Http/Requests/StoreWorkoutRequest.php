<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreWorkoutRequest extends FormRequest
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
        return [
            'name' => [
                'required',
                Rule::unique('workouts')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    ),
            ],
            'sets' => ['required', 'array'],
            'sets.*.reps' => ['required', 'integer'],
            'sets.*.weight' => ['required', 'integer'],
        ];
    }

}
