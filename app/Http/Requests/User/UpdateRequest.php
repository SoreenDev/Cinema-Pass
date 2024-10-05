<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['string', 'min:3', 'max:255'],
            'last_name' => ['string', 'min:3', 'max:255'],
            'user_name' => ['string', 'min:3', 'max:255'],
            'email' => ['email', 'max:255'],
            'city_id' => ['integer', 'exists:cities,id'],
            'password' => ['string', 'min:8', 'max:255', 'confirmed'],
            'profile' => ['file', 'mimes:png,jpg,jpeg'],
        ];
    }
}
