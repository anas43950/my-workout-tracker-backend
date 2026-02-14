<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRoutineRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'id' => [
                'required',
                Rule::exists('routines')
                    ->where(
                        fn($query) =>
                        $query
                            ->where('user_id', $this->user()->id)
                    )
            ],
            'name' => [
                'sometimes',
                'string',
                Rule::unique('routines')
                    ->where(
                        fn($query) =>
                        $query
                            ->where('user_id', $this->user()->id)
                            ->where('id', '!=', $this->id)
                    )
            ],
            'exercises_ids' => [
                'required',
                'array'
            ],
            'exercises_ids.*' => [
                'integer',
                Rule::exists('exercises', 'id')
                    ->where(
                        fn($query) =>
                        $query->where('user_id', $this->user()->id)
                    )

            ]
        ];
        return $rules;
    }
}
