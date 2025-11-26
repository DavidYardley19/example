<?php

namespace App\Http\Controllers;

use App\Models\Job;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with('employer')->latest()->simplePaginate(3);

        return view('jobs.index', [
            'greeting' => 'Hello, welcome to the jobs page!',
            'name' => 'DavBot',

            // 'jobs' => Job::all()
            // replace the above with this:
            'jobs' => $jobs
        ]);
    }

    public function create() {
        //
    }

    public function show($id) {
        //
    }

    public function store() {
        //
    }

    public function edit() {
        //
    }

    public function update() {
        //
    }

    public function destroy() {
        //
    }
}
