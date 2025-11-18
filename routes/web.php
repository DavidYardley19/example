<?php

use Illuminate\Support\Facades\Route;

// when you visit this page, runs a function
// declared route that LISTENS for GET requests to the root URL ('/')
// function returns a view called welcome, check resources/views/welcome.blade.php
Route::get('/', function () {
    return view('home');
});

// Ep2 (time 4:40) - added a new route for /about page
Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});
