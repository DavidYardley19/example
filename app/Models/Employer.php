<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /** @use HasFactory<\Database\Factories\EmployerFactory> */
    use HasFactory;

    public function jobs() {
        // has many is here because an employer can have many jobs that they release.
        return $this->hasMany(Job::class);
    }

    // $employer -> jobs
    // this will get all jobs for a specific employer
    // note the semantics here.
        // using jobs plural because its a collection of jobs
        // in the job model, we use employer singular because its a single employer for that job
        // thus the code there wasnt hasMany but belongsTo
}
