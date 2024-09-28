<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Performance;
use App\Models\User;
use Illuminate\Database\Seeder;

class PerformanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory(10)->create();
        $users = User::pluck('id')->toArray();

        Performance::factory(30)->create()->
        each(function (Performance $performance)use($users) {
            $performance->comments()->create([
                'body' => fake()->realText,
                'user_id' => $users[array_rand($users)]
            ])->scores()->create([
                'user_id' => $users[array_rand($users)],
            ]);

            $performance->scores()->create([
                'user_id' => $users[array_rand($users)],
                'point' => rand(1,10)

            ]);
        });
    }
}
