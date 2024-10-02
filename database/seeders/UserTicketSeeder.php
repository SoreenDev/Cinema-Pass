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
        $users = User::all()->pluck('id');
        $daily_screens = DailyScreenings::all();
         for ($i = 0; $i < 200; $i++) {
             $daily_screen= $daily_screens->random();
             UserTicket::create([
                 'user_id' => $users->random(),
                 'daily_screenings_id' => $daily_screen->id,
                 'performance_id' => $daily_screen->performance_id,
                 'price' => '0'
             ]);
         }
    }
}
