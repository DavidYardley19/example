<?php
namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employer;

class Job extends Model {
    use HasFactory; // allows for the factory method call.
    protected $table = 'job_listings';

        protected $fillable = [
        'title',
        'salary'
    ];

    public function employer() {
        return $this->belongsTo(Employer::class);
        // must ask if it works in reverse too
        // has many would be used because one employer may have many jobs going
    }
}
