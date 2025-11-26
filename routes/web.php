<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::view('/', 'home')->name('home');
Route::view('/contact', 'contact')->name('contact');

Route::get('/jobs', [JobController::class, 'index'])->name('jobs');
Route::get('/jobs/create', [JobController::class, 'create'])->name('job');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('job');
Route::post('/jobs', [JobController::class, 'store'])->name('job');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('job');
Route::patch('/jobs/{job}', [JobController::class, 'update'])->name('job');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('job');


