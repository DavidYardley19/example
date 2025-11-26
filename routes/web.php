<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello, welcome to the home page!',
        'name' => 'DavBot'
    ]);
})->name('home');

// index
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');

// create
Route::get('/jobs/create', function(){

    return view('jobs.create');
});

//show
Route::get('/jobs/{job}', function (Job $job) {
    return View('jobs.show', ['job' => $job]);
})->name('job');

// store
Route::post('/jobs', function () {

    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => 'required'
    ]);

    Job::create([
        'title' => request('title'),
        'salary' => request('salary'),

        'employer_id' => 1
    ]);

    return redirect('/jobs');
});

// edit
Route::get('/jobs/{job}/edit', function (Job $job) {
    return View('jobs.edit', ['job' => $job]);
})->name('job');

// update (uses same uri as show, but different method)
Route::patch('/jobs/{job}', function (Job $job) {
    // authorise needed here
    request()->validate([
        'title' => ['required', 'min:3'],
        'salary' => 'required'
    ]);

        $job->update(request()->only(['title', 'salary']));
    return redirect('/jobs/' . $job->id);

})->name('job');

Route::delete('/jobs/{job}', function (Job $job) {
    $job->delete();
    return redirect('/jobs');
})->name('job');

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
