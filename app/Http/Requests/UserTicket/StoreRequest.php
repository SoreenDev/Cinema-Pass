<?php

namespace App\Http\Requests\UserTicket;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'daily_screenings_id' => ['required', 'integer' , 'exists:daily_screenings,id'],
        ];
    }
}
