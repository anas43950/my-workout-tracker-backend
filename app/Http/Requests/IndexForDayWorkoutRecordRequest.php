<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexForDayWorkoutRecordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'created_at' => ['required', Rule::date()]
        ];
    }

    public function messages()
    {
        return [
            'created_at.required' => '\'created_at\' field is required'
        ];
    }
}
