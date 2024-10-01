<?php

namespace App\Http\Requests\Performance;

use App\Enums\ActivityEnum;
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
            'name' => ['string','max:255', 'unique:performances,name'],
            'category_id' => [ 'integer', 'exists:categories,id'],
            'duration' => ['date_format:H:i:s'],
            'age_group' => [
                'integer',
                Rule::enum(AgeGroupEnum::class)
            ],
            'description' => ['string'],
            'price' => ['numeric', 'min:50'],
            'production_data' => ['date'. 'date_format:Y-m-d'],
            'agents' => ['array'],
            'agents.*.id' => ['required','integer', 'exists:agents,id'],
            'agents.*.exception' => ['required','bool'],
            'agents.*.activity' => ['required','string', Rule::enum(ActivityEnum::class)],
        ];
    }
}
