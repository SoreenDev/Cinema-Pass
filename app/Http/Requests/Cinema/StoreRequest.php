<?php

namespace App\Http\Requests\Cinema;

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
            'name' => ['required','string','max:255','unique:cinemas,name'],
            'address' => ['required','string','max:255'],
            'city_id' => ['required', 'integer','exists:cities,id'],
            'location' => ['nullable', 'string','max:255'],
            'description' => ['required','string','max:255'],
            'phone' => ['nullable','string','digits:9','unique:cinemas,phone'],
            'entry_fee' => ['required', 'numeric','min:50'],
        ];
    }
}
