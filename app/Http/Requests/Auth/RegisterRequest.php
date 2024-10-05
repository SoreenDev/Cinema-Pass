<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255','unique:users,user_name'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'city_id' => ['required', 'integer','exists:cities,id'],
            'password' => ['required', 'string', 'min:8', 'max:255', 'confirmed'],
            'profile' => ['file', 'mimes:png,jpg,jpeg'],
        ];
    }
}
