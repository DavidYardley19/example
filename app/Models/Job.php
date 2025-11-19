<?php
namespace App\Models;
// Namespace correlates to the directory.
    // way to organise code > identify what classes, methods, etc, belong where/ come from where.

    // Check out composer.json > autoload > psr-4
    // "App\\": "app/"  means anything with namespace App\ (like App\Models) maps to app/ directory.
public class Job {
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
}