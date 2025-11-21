<?php

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
        Schema::create('match_plays', function (Blueprint $table) {
            $table->id();
            $table->string('home_team');
            $table->string('away_team');
            $table->string('location');
            $table->date('match_date');
            // whats the best way to measure the score?
            $table->integer('home_team_score')->nullable();
            $table->integer('away_team_score')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_plays');
    }
};
