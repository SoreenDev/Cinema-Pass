<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
        PermissionSeeder::class,
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $role = Role::findOrCreate('Admin');
        $this->call($this->seedersCall);
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'user_name' => 'admin',
            'city_id' => 1,
            'email' => 'soreendev@gmail.com',
            'password' => '123456789'

        ])->assignRole($role);
    }
}
