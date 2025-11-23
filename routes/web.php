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

Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->simplePaginate(3);
    // just has a prev and next button. This is fine unless a user really wants to jump pages.

    // $jobs = Job::with('employer')->cursorPaginate(3);
    // if you hover over the next button, the url will have a cursor value... this is random asf
        // you drop the ability to jump to specific pages, but its more efficient for large datasets
        // good for infinite scrolls

    $jobs = Job::with('employer')->simplePaginate(3);

    
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
