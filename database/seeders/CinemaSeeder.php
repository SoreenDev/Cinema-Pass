<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\City;
use App\Models\Facilities;
use App\Models\User;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        foreach ($cities as $city)
            Cinema::factory(3)->create([
                "city_id" => $city
            ])->each(
                function($cinema) use ( $users) {
                    Facilities::factory(rand(2,4))->create(['cinema_id' => $cinema->id]);
                    $cinema->comments()->create([
                        'body' => fake()->realText,
                        'user_id' => $users[array_rand($users)]
                    ])->scores()->create([
                        'user_id' => $users[array_rand($users)],
                    ]);
            });
    }
}


