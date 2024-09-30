<?php

namespace App\Http\Requests\PerformanceAgent;

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
            'performance_id' => ['exists:performances,id'],
            'agent_id' => ['exists:agents,id'],
            'activity' => [
                'string',
                Rule::enum(ActivityEnum::class)
            ],
            'exception' => ['boolean'],
        ];
    }
}
