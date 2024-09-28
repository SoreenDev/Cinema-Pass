<?php

namespace Database\Seeders;

use App\Enums\ActivityEnum;
use App\Models\Agent;
use App\Models\Performance;
use App\Models\PerformanceAgent;
use Illuminate\Database\Seeder;

class PerformanceAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $performances = Performance::pluck('id')->toArray();
        $agents = Agent::pluck('id')->toArray();
        foreach ($performances as $performance) {
            PerformanceAgent::create([
                'performance_id' => $performance,
                'agent_id' => $agents[array_rand($agents)],
                'activity' => ActivityEnum::Director
            ]);
            PerformanceAgent::create([
                'performance_id' => $performance,
                'agent_id' => $agents[array_rand($agents)],
                'activity' => ActivityEnum::Screenwriter
            ]);
            for ($i = 0 ; $i < 8; ++$i)
                PerformanceAgent::create([
                    'performance_id' => $performance,
                    'agent_id' => $agents[array_rand($agents)],
                    'activity' => ActivityEnum::Actor,
                    'exception' => fake()->boolean(30)
                ]);
        }
    }
}
