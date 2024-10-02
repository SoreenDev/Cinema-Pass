<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public array $seedersCall =[
        CitySeeder::class,
        UserSeeder::class,
        CinemaSeeder::class,
        AgentSeeder::class,
        PerformanceSeeder::class,
        DailyScreeningSeeder::class,
        UserTicketSeeder::class,
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call($this->seedersCall);
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'user_name' => 'admin',
            'city_id' => 1,
            'email' => 'soreendev@gmail.com',
            'password' => '123456789'

        ]);
    }
}
