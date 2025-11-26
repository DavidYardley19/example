<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/', function () {
    return view('home', [
        'greeting' => 'Hello, welcome to the home page!',
        'name' => 'DavBot'
    ]);
})->name('home');

// index
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

// create
Route::get('/jobs/create', function(){

    return view('jobs.create');
});

//show
Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return View('jobs.show', ['job' => $job]);
})->name('job');

// store
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

// edit
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return View('jobs.edit', ['job' => $job]);
})->name('job');

// update (uses same uri as show, but different method)
Route::patch('/jobs/{id}', function ($id) {
    // validae request
    request()->validate([
        'title' => ['required', 'min:3'],
        // min 3 means minimum 3 characters
        'salary' => 'required'
    ]);
    // authorise request - must be by person who created the job - later when auth is set up

    // update job
    $job = Job::findOrFail($id); // find returns null if not found... can swap with findOrFail to throw 404 error


        //can set up props individually
        // $job->title = request('title');
        // $job->salary = request('salary');
        // $job->save();

        // can also leverage job update
        $job->update(request()->only(['title', 'salary']));

    // redirect to jobs page so you can see changes take effect
    return redirect('/jobs/' . $job->id);

})->name('job');

// destroy
Route::delete('/jobs/{id}', function ($id) {
    // authorise request
    $job = Job::findOrFail($id);
    // delete job
    $job->delete();
    //redirect - send back to index
    return redirect('/jobs');
})->name('job');

Route::get('/contact', function () {
    return view('contact', [
        'greeting' => 'Hello, welcome to the contact page!',
        'name' => 'DavBot'
    ]);
})->name('contact');
