<?php

namespace App\Http\Requests\Agent;

use App\Enums\ActivityEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['string','max:255','unique:agents,name'],
            'description' => ['string'],
            'long_description' => ['string'],
            'activity' => [
                'string',
                Rule::enum(ActivityEnum::class)
            ],
        ];
    }
}
