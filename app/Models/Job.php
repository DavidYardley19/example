<?php
namespace App\Models;
use Illuminate\Support\Arr;

// Namespace correlates to the directory.
    // way to organise code > identify what classes, methods, etc, belong where/ come from where.

    // Check out composer.json > autoload > psr-4
    // "App\\": "app/"  means anything with namespace App\ (like App\Models) maps to app/ directory.

class Job {
    public static function all() : array {
        return [
            [
                'id' => 1,
                'title' => 'Web Developer',
                'salary' => '£50,000',
            ],
            [
                'id' => 2,
                'title' => 'Designer',
                'salary' => '£60,000',
            ],
            [
                'id' => 3,
                'title' => 'Content Creator',
                'salary' => '£70,000',
            ]
        ];
    }

    // : array = clearly define the return type of the function
    // Need to deal with this when null is returned.
    public static function find(int $id) : array
    {
            $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);
            // below means check if null...
            if (!$job) {
                abort(404);
            }
            return $job;
    }
}
