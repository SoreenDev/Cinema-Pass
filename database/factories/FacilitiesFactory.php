<?php

namespace Database\Factories;

use App\Models\Facilities;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Facilities>
 */
class FacilitiesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
        ];
    }
}
