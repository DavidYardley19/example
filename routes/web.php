<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
// The above is case sensitive!

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello, welcome to the home page!',
        'name' => 'DavBot'
    ]);
})->name('home');

// amended the about page to jobs page, reflected in the view too (resources/views/jobs.blade.php)
Route::get('/jobs', function () {
    // With() = eager loading employer relatinships here. Prevents N+1 query problem.
    $jobs = Job::with('employer')->get();

    // testing without eager loading
    // $jobs = Job::all();
    
    return view('jobs', [
        'greeting' => 'Hello, welcome to the jobs page!',
        'name' => 'DavBot',

        // 'jobs' => Job::all()
        // replace the above with this:
        'jobs' => $jobs
    ]);
})->name('jobs');

// need to create a route for the above > Listen for get requests to jobs/id
// Laravel detects the thing wrapped in braces as a wild card
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return View('job', ['job' => $job]);
})->name('job');

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
