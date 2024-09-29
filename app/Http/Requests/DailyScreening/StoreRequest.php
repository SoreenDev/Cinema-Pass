<?php

namespace App\Http\Requests\DailyScreening;

use App\Enums\TurnToPlayEnum;
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
            'cinema_id' => ['required', 'integer','exists:cinemas,id'],
            'performance_id' => ['required', 'integer','exists:performances,id'],
            'date' => [
                'required',
                'date',
                'date_format:Y-m-d',
            ],
            'hour' => ['required', 'integer',Rule::enum(TurnToPlayEnum::class)],
        ];
    }

    public function messages(): array
    {
        return [
            'hour.enum' => 'The hour must be allowed from the time format',
        ];
    }
}
