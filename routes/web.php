<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello, welcome to the home page!',
        'name' => 'DavBot'
    ]);
})->name('home');

Route::get('/jobs', function () {

    $jobs = Job::with('employer')->latest()->simplePaginate(3);

    
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

Route::post('/jobs', function () {

    // validate the incoming request data >> So you don't have to do "required" in the HTML form
    // I feel like this is better practice.
    request()->validate([
        'title' => ['required', 'min:3'],
        // min 3 means minimum 3 characters
        'salary' => 'required'
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),

        // issue with the below- this is because this is in context of the fillable field.
        // go back to the job model - you will see fillable fields.
        'employer_id' => 1 // need to set up authentication later.
    ]);

    return redirect('/jobs');
});

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
