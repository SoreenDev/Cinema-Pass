<?php

namespace Database\Seeders;

use App\Models\DailyScreenings;
use App\Models\User;
use App\Models\UserTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $daily_screens = DailyScreenings::pluck('id')->toArray();
         for ($i = 0; $i < count($daily_screens); $i++)
             UserTicket::create([
                 'user_id' => $users[array_rand($users)],
                 'daily_screenings_id' => $daily_screens[array_rand($daily_screens)],
             ]);
    }
}
