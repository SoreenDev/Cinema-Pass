<?php

namespace App\Http\Requests\Performance;

use App\Enums\AgeGroupEnum;
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
            'name' => ['sometimes','string','max:255', 'unique:performances,name'],
            'category_id' => ['sometimes', 'integer', 'exists:categories,id'],
            'duration' => ['sometimes','date_format:H:i:s'],
            'age_group' => [
                'sometimes',
                'integer',
                Rule::enum(AgeGroupEnum::class)
            ],
            'description' => ['sometimes','string'],
            'price' => ['sometimes', 'numeric', 'min:50'],
            'production_data' => ['date'.'date_format:Y-m-d'],
        ];
    }
}
