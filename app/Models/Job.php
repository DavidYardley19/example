<?php
namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Employer;

class Job extends Model {
    use HasFactory; // allows for the factory method call.
    protected $table = 'job_listings';

    // this can be annoying for some programmers- to have to amend this over and over
    // as long as you understand the dangers, you can disable mass assignment protection
    // use guarded instead of fillable to disable it
    // protected $guarded = []; // all fields are mass assignable
    // think whitelist vs blacklist
    
    // protected $fillable = [
    //     'title',
    //     'salary',
    //     'employer_id'
    // ];

    protected $guarded = []; // all fields are mass assignable

    public function employer() {
        return $this->belongsTo(Employer::class);
        // must ask if it works in reverse too
        // has many would be used because one employer may have many jobs going
    }

    // 8min 20 - pivot tables and belongstomany relationships
    public function tags() {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }

}
