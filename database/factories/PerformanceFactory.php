<?php

namespace Database\Factories;

use App\Enums\AgeGroupEnum;
use App\Models\Category;
use App\Models\Performance;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Performance>
 */
class PerformanceFactory extends Factory
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
            'duration' => '02:00:00',
            'age_group' => fake()->randomElement(AgeGroupEnum::cases()),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(500, 1000),
            'category_id' => fake()->randomElement(Category::pluck('id')->toArray()),
        ];
    }
}
