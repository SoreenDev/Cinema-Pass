<?php

namespace App\Http\Requests\Agent;

use App\Enums\ActivityEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['required','string','max:255','unique:agents,name'],
            'description' => ['required','string'],
            'long_description' => ['string'],
            'activity' => [
                'required',
                'string',
                Rule::enum(ActivityEnum::class)
            ],
        ];
    }
}
