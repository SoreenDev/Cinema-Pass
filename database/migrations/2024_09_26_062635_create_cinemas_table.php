<?php

use App\Models\City;
use App\Models\Facilities;
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
        Schema::create('cinemas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->foreignIdFor(Facilities::class)->nullable();
            $table->foreignIdFor(City::class);
            $table->string('location')->nullable();
            $table->text('description');
            $table->string('phone')->nullable();
            $table->unsignedInteger('entry_fee');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinemas');
    }
};
