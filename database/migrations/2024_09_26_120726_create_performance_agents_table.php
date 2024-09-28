<?php

use App\Enums\ActivityEnum;
use App\Models\Agent;
use App\Models\Performance;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('performance_agents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Performance::class);
            $table->foreignIdFor(Agent::class);
            $table->string('activity')->default(ActivityEnum::Actor);
            $table->boolean('exception')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_agents');
    }
};
