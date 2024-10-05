<?php

namespace App\Http\Requests\Cinema;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateReaquest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes','string','max:255','unique:cinemas,name'],
            'address' => ['sometimes','string','max:255'],
            'city_id' => ['sometimes', 'integer','exists:cities,id'],
            'location' => ['nullable', 'string','max:255'],
            'description' => ['sometimes','string','max:255'],
            'phone' => ['sometimes','string','digits:9','unique:cinemas,phone'],
            'entry_fee' => ['required', 'numeric','min:50'],
            'image' => ['file','mimes:jpg,png,jpeg'],
        ];
    }
}
