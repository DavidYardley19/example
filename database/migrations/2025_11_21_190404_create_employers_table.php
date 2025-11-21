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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            // I was sat here thinking.. why is there no FK for job listings?
            // then I remembered its the other way round, job listings has the FK for employers
            // so no need to add anything else here
            
            // is this in relation to lazy loading?
            // or eager loading?
            // or is that something different entirely?
            // I think its different, those are about how related models are fetched
            // this is just about the table structure itself.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
