<?php

namespace Database\Factories;

use App\Enums\ActivityEnum;
use App\Models\Agent;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Agent>
 */
class AgentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'activity' => fake()->randomElement(ActivityEnum::cases()),
            'description' => fake()->sentence,
            'long_description' => fake()->text(),
        ];
    }
}
