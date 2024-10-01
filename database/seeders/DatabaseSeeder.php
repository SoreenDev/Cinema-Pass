<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public array $seedersCall =[
        CitySeeder::class,
        UserSeeder::class,
        CinemaSeeder::class,
        PerformanceSeeder::class,
        AgentSeeder::class,
        DailyScreeningSeeder::class,
        UserTicketSeeder::class
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call($this->seedersCall);
    }
}
