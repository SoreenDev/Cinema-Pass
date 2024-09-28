<?php

namespace Database\Seeders;

use App\Enums\TurnToPlayEnum;
use App\Models\Cinema;
use App\Models\Performance;
use Illuminate\Database\Seeder;

class DailyScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cinemas = Cinema::all();
        $performances = Performance::select('id','price')->get();

        for ($i = 0; $i < 7; $i++) {

            foreach ($cinemas as $cinema) {
                $turns = TurnToPlayEnum::cases();
                $performance = $performances->random(rand(2,count($turns)));
                for ($j = 0; $j < count($performance); $j++)
                    $cinema->daily_screenings()->create([
                        'performance_id' => $performance[$j]->id,
                        'cinema_id' => $cinema->id,
                        'city_id' => $cinema->city_id,
                        'final_ticket_cost' => $cinema->entry_fee + $performance[$j]->price,
                        'start_time' => today()->addDay($i)->setHour($turns[$j]->value)
                    ]);
            }

        }
    }
}
