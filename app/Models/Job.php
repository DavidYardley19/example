<?php
namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;

// Namespace correlates to the directory.
    // way to organise code > identify what classes, methods, etc, belong where/ come from where.

    // Check out composer.json > autoload > psr-4
    // "App\\": "app/"  means anything with namespace App\ (like App\Models) maps to app/ directory.

    // Because we extended Eloquent Model, we get a lot of functionality for free.
    // No need to write code for basic CRUD operations.
    // such as Job::all() to get all jobs from jobs table.
        // or Job::find($id) to get a job by its primary key.
class Job extends Model {

    }
