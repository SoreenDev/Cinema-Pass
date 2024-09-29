<?php

namespace App\Http\Requests\Performance;

use App\Enums\AgeGroupEnum;
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
            'name' => ['required','string','max:255', 'unique:performances,name'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'duration' => ['required','date_format:H:i:s'],
            'age_group' => [
                'required',
                'integer',
                Rule::enum(AgeGroupEnum::class)
            ],
            'description' => ['required','string'],
            'price' => ['required', 'numeric', 'min:50'],
            'production_data' => ['nullable', 'date'.'date_format:Y-m-d'],
        ];
    }
}
