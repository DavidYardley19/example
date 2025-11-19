<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Arr;

Route::get('/', function () {
    return view('home', [
    'greeting' => 'Hello, welcome to the home page!', // access to a variable $greeting
    'name' => 'DavBot',
    ]);
})->name('home');

// amended the about page to jobs page, reflected in the view too (resources/views/jobs.blade.php)
Route::get('/jobs', function () {
    return view('jobs', [
        'greeting' => 'Hello, welcome to the jobs page!',
        'name' => 'DavBot',

        'jobs' =>
        [
            [
                'id' => 1, // added unique identifier for each job, helps create hooks later on
                'title' => 'Web Developer',
                'salary' => '£50,000',
            ],
            [
                'id' => 2,
                'title' => 'Designer',
                'salary' => '£60,000',
            ],
            [
                'id' => 3,
                'title' => 'Content Creator',
                'salary' => '£70,000',
            ] // no need to end on a comma.
        ]
    ]);
})->name('jobs');

// need to create a route for the above > Listen for get requests to jobs/id
// Laravel detects the thing wrapped in braces as a wild card
Route::get('/jobs/{id}', function ($id) {
    $jobs =
        [
            [
                'id' => 1, // added unique identifier for each job, helps create hooks later on
                'title' => 'Web Developer',
                'salary' => '£50,000',
            ],
            [
                'id' => 2,
                'title' => 'Designer',
                'salary' => '£60,000',
            ],
            [
                'id' => 3,
                'title' => 'Content Creator',
                'salary' => '£70,000',
            ]
        ];

    $job = Arr::first($jobs, fn($job) => $job['id'] == $id);

    // dd($job);
    
    return View('job', ['job' => $job]);
})->name('job.show');

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
