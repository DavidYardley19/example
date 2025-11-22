<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    public function jobs() {
        return $this->belongsToMany(Job::class, relatedPivotKey: 'job_listing_id');
    }

    // need to check on this... relatedPivotKey or foreignPivotKey?
    // how do you know
    // ans: relatedPivotKey is for the other model, foreignPivotKey is for this model
    public function posts() {
        return $this->belongsToMany(Post::class, relatedPivotKey: 'post_id');
    }
}
