<?php
namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model {
    use HasFactory; // allows for the factory method call.
    protected $table = 'job_listings';

        protected $fillable = [
        'title',
        'salary'
    ];
    }
