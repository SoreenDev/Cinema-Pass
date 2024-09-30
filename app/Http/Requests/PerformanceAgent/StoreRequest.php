<?php

namespace App\Http\Requests\PerformanceAgent;

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
            'performance_id' => ['required', 'exists:performances,id'],
            'agent_id' => ['required', 'exists:agents,id'],
            'activity' => [
                'required',
                'string',
                Rule::enum(ActivityEnum::class)
            ],
            'exception' => ['boolean'],
        ];
    }
}
