<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * applying the operation, whats changed to the db
     */
    public function up(): void
    {
        Schema::create('job_listings', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            // below could be set to integer or decimal for more precise salary representation
            // string is kept for simplicity and compatibility with existing code
            $table->string('salary');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * undoing the operation, rolling back the changes to the db
     */
    public function down(): void
    {
        Schema::dropIfExists('job_listings');
    }
};
