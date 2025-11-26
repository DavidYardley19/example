<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;

Route::view('/', 'home');
Route::view('/contact', 'contact');

// Route::controller(JobController::class)->group(function () {
//     Route::get('/jobs', 'index');
//     Route::get('/jobs/create', 'create');
//     Route::get('/jobs/{job}', 'show');
//     Route::post('/jobs', 'store');
//     Route::get('/jobs/{job}/edit', 'edit');
//     Route::patch('/jobs/{job}', 'update');
//     Route::delete('/jobs/{job}', 'destroy');
// });

// can be shorted down with route::resource:

Route::resource('jobs', JobController::class, [
    'except' => ['edit']
]);

// often you dont need to gen ALL 7 routes.
// you can specify only the ones you need like so:
    // or you can do the inverse and exclude the ones you dont need:
    // edit will then dissapear

// you can use only if you wish