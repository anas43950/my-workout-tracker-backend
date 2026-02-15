<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexForRoutineWorkoutsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'routine_id' => ['required', Rule::exists('routines', 'id')
                ->where(
                    fn($query) =>
                    $query->where('user_id', $this->user()->id)
                )]
        ];
    }
}
