<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Job;
use App\Models\Tag;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('job_tag', function (Blueprint $table) {
            $table->id();
            // going to overwrite the foreign names to match the models
            $table->foreignIdFor(Job::class, 'job_listing_id')->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            // how do i get the above two lines to apply in tablePlus?
            // I think they will show as job_listing_id and tag_id as expected
            // but how do i prevent orphaned entries if a job or tag is deleted?
            // cascadeOnDelete should handle that
            // well it isnt..
            // so I need to write a manual query to clean up orphaned entries
            // no help
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('job_tag');
    }
};
