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
