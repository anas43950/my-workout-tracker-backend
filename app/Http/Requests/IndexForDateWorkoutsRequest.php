<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexForDateWorkoutsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'date' => ['required', 'date']
        ];
    }
}
