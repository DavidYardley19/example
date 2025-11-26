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

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');

// index
Route::get('/jobs', [JobController::class, 'index'])->name('jobs');

// create
Route::get('/jobs/create', [JobController::class, 'create'])->name('job');

//show
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('job');

// store
Route::post('/jobs', [JobController::class, 'store'])->name('job');

// edit
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('job');

// update (uses same uri as show, but different method)
Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('job');

// destroy
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('job');


