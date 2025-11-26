<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('jobs.index');
    Route::get('/jobs/create', 'create')->name('jobs.create');
    Route::get('/jobs/{job}', 'show')->name('jobs.show');
    Route::post('/jobs', 'store')->name('jobs.store');
    Route::get('/jobs/{job}/edit', 'edit')->name('jobs.edit');
    Route::patch('/jobs/{job}', 'update')->name('jobs.update');
    Route::delete('/jobs/{job}', 'destroy')->name('jobs.destroy');
});



