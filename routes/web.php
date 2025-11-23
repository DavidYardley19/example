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

    $jobs = Job::with('employer')->simplePaginate(3);

    
    return view('jobs.index', [
        'greeting' => 'Hello, welcome to the jobs page!',
        'name' => 'DavBot',

        // 'jobs' => Job::all()
        // replace the above with this:
        'jobs' => $jobs
    ]);
})->name('jobs');

// need a route for job: adding a job
Route::get('/jobs/create', function(){
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return View('jobs.show', ['job' => $job]);
})->name('job');

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
