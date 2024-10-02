<?php

namespace Database\Seeders;

use App\Enums\ActivityEnum;
use App\Models\Agent;
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
        $users = User::all()->pluck('id');
        $agents = Agent::all()->pluck('id');

        Performance::factory(30)->create()->each(
            function (Performance $performance) use ($users, $agents) {
                $performance->comments()->create([
                    'body' => fake()->realText,
                    'user_id' => $users->random()
                ])->scores()->create([
                    'user_id' => $users->random(),
                ]);

                $performance->scores()->create([
                    'user_id' => $users->random(),
                    'point' => rand(1,10)

                ]);
                $agents->random(rand(5, 10))->each(function ($agent) use ($performance) {
                    $performance->agents()->attach($agent, [
                        "activity" => ActivityEnum::Actor->value,
                        "exception" => rand(0, 1),
                    ]);
                });
            });
    }
}
