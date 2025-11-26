# Tasks Completed
## Ep 1 - Hello, Laravel
Video demo's how to get the environments set up - namely HERD (good to get projects set up and monitoring)
Also going to utilise visual studio code - feel most familiar with this.

## Ep 2 - Your first route and view
Checked out the filestructure
Brushed over the routes to begin with.
Route::get('/', function() {return view('welcome');});
This bit of code does the following.
1. declare a route
2. listens for a GET request, TO the root URL
3. runs a function if so, which returns a view called welcome
This view can be located in resources/views/welcome.blade.php

Blade is a laravel templating engine.
Cleaner syntax + additional features for dynamic web pages.
Roughly 5 mins into episode2 > Going to publish work to this repo. See yall soon.

## Ep 3 - Create a layout file using laravel components
Layout file created to reduce repeated code.
Again- blade = templating engine for laravel. It offers helpers, shortcuts, directives and layout capabilities.
Components directory created to store all of these, not case sensitive.

When calling a component elsewhere, you would use <x-componentName>
The x- prefix = ensures tag is unique and doesnt conflict with standard html
    So in theory, <x-h1> would be fine?

{{ $slot }} = <?php echo $slot; ?>
Where unique page content should be inserted
This was used to differenciate between each page body.

Homework provided to replicate this learning with the navigaion elements.
I made progress but it wasnt QUITE right.
start of episode 4 showed it was best to stick the logic within the layout component rather than each view. REMEMBER DRY dave.

## Ep 4 - Make a pretty layout using TailwindCSS
check out tailwindui.com
    Free example components are here > brows components > application ui 
    The first one is usually free, rest require payment.
        Just trading your money for time... but if you get proficient, all should be fine
Removed some code in relation to the profile dropdown for both web and mobile code.

Going to amend the message displayed on each page using {{ these again }}
two options: pass as a prop ... i.e. x-layout heading=''  
    OR can pass as a named slot - assigned to distinguish. Kind of like ID?
    Stuck to named slots as this was the path of least resistance for now.

Quick note: {{ $heading ?? $title ?? 'Dashboard' }}
This is like a fallback method... if elseif else
heading, question mark? no? ... title, question mark? no?... Alright. Here you go then, Dashboard.
    But I do not believe the last resort MUST be a string, surely it can be any process, method, function etc

NO HOMEWORK

## Ep 5 - Style the currently active navigation link
class h-full means the full height is taken up

The below line allows for conditional setting of styles. But need to decide what determines this true/false with the laravels request helper function (theres a method called 'is')
                class= "{{ false ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">

aria-current > Essential for screenwriters
    indicates if current link represents current page

CURRENT CODE
a class= "{{ request()->is('/') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
    aria-current = "{{ request()->is('/') ? 'page' : 'false' }}"
    {{$slot}}
ISSUE
This is only specific to the home page, need something a little more dynamic through the use of props
    Something to indicate if nav link should be marked as the active nav link.
        ATTRIBUTES (class id name)
        PROPS (anything that isnt an attribute) -> Not echo'd 

Adding {{attributes}} into an tag will allow you to see ALL attributes such as href, class, name, id 
(when inspecting element)

active="false" >> false is treated as a string
:active="false" >> false is treated as a boolean

HOMEWORK
Introduce a new prop >
    type
        whether navlink should be rendered as an achor tag or button tag
            conditional > if type = a > anchor tag
                          if type = button > button tag

RECAP
Quick recap (19/11/25) - ep5
bg-grey900, bg-grey100 ... 900 is darkest, 100 is lightest.
    Conditionals were sorted to determine what to do with anchor tags stylings (with above colours bg-grey...)

Used class="{{ request()->is()}}"
    To check if theres a match with whats in the is (such as '/')
        Then runs what comes after the question mark.
            Alternative is what comes after the colon (an else section)

Component added for nav-links... nav-link.blade.php
    Then the a tags in the layouts component can change to x-nav-link

aria-current="false"
    Important for production apps, screenwriters - if current link represents current page or list of pages.
    aria-current="{{request()->is('/') ? 'page' : 'false'}}"
        TODO : check on what this really means. Still not clicking

Attributes - html, href, id, class
Props - anything that is not an attribute, 
    Distinguished by specifying not to echo this out
    HOW? Blade directive- @props(['active'])
        This is an array so you dont need to keep writing @props.. just use that one
    Can give default values, just incase its not passed in when referencing nav-link.
        @props(['active'=>'false'])

Differenciate between strings and booleans
    'false' = string
    :'false' = boolean
        >> When prefixingt prop names.

Can also create a @php directive (with @endphp)
    Within here, some conditionals can be set.
    Tweak specific values
    All is isolated in this component

## Ep 6 - View Data and Route Wildcards

Recap on homework from Ep 5

Learnt how to pass data into views.
    eg. 'greeting' => 'Hello'
Complex data could be passed in.
    'jobs' => [['id => 1, 'title' => 'jobA'],[same again],[same again]]

@foreach directive used to loop over the jobs

Dynamic job listings pages set up
    Created a new Route::get for ("jobs/{id}")
    A $jobs variable was passed in allong with a collect() method (helper) to create a collection from the array
        the first() method with a callback meant we could find the job by the ID
This was tidied up nicely however with the following line
    fn ($job) => $job['id] == $id

A new view created: job.blade.php
    this displayed details
    Each title was made clickable and styling appended for visual clarity of UX

SUMMARY
    Conditionally render anchor or button tags (props)
    Passed data (arrays) from routes to views
    Loop over arrays using blade directive @foreach
    Dynamic routes with URL params
    Laravel collections and closures to find array items
    Built individual details pages linked from a list

HOMEWORK
    no homework. Done plenty here!

## Ep 7 - Autoloading, Namespaces and Models
Going to start with the summary so I know what is coming up

SUMMARY (PRE-STUDY)
    Removed duplicated job data by centralizing in a Job model
    Leant about MVC and role of the models
    Used PSR-4 autoloading + namespaces (organises code)
    Added a find method to the model (encapsulates data lookup)
    Handled missing data gracefully (laravels abort(404) helper)

Notes (PRE-STUDY)
    moving array of jobs up one level in the routes file means...
        it can be shared across multiple routes without duplication.
        reduces redundancy while keeping data accessible
    
    Static method all() on a class will return an entire array (jobs in this class)
    Encapsulation makes the data easier to manage and prepares us for adding behaviour and logic
        string together a bunch of methods in one go, even (? possibly. ?)
    (need to update all routes to use Job::all() instead of the duped array)

    MVC and Models
    Model - represents data and business logic (data persistence, business rules such as how jobs are created updated or deleted.)
    View - Handles presentation, and user interface
    Controller - Manages user input and interaction (shown as route handlers in laravel usually)

    Adding a method to the job model-
    Already moved logic for finding a job by ID into the job model as a static find method.
        This uses Arr helper to find the first job matching a given ID (or returns null if not found)
        Within the route, we replaced inline logic with a call to Job::find($id)
    
    Handling missing data (sad path)
    If job with the requested ID does not exist,
        find method returns null
            handle this case with aborting with a 404 response (abort(404))
                Laravels helper (abort) throw an exception
                    Laravel catches and converts into a PROPPER 404 HTTP RESPONSE!!! CRAZY. maybe not

## Ep 8 - Introduction to Migrations
### SUMMARY (pre-study)
Default db = sqlite. But can support other
.env file manages config
artisan commands manage migrations + db schema
Migrations define db structure + support vers control
TablePlus = great GUI for managing DB
Created a migration for job_listings table > populated with sample data

### Pre-Notes
On laravel install- it asked which db you wanted, sqlite was default
Suitable for many apps unless you expect a much larger scale app.
config in .env file
    Enviroment specific settings    
        db creds, debug mode, cache drivers, api keys
        PURPOSE: keeps sensitive info out of codebase and vers control

Artisan Commands and DB migrations
artisan = cli tool... all commands in cmd prompt start with 'php artisan'
EXAMPLE COMMANDS
    php artisan migrate
        runs pending migrations to create or update db tables
    php artisan migrate:refresh
        rolls back migrations, runs them again (good for devmnt)
    php artisan migrate:rollback
        rollback to last batch of migrations
migrations = php classes
    define structure of db tables, allow vc db schema + share with others.

TablePlus for DB management
(recommended) GUI tool - manage DB's.
Supports multiple DB types (e.g. sqlite, mysql, postgresql)
Can connect tablePlus to sqlite db by pointing database/database.sqlite file
    lets you inspect tables, view data, modify schema visually

Understanding Migrations
2 methods
    up() >>> defines changes to apply
        creating tables, adding columns
    down() >>> defines how to revert changes
        drop tables, rm columns
EXAMPLE: migration to create job_listings
    may include cols for id title salary
        you can add/ mod columns by creating new migrations

Creating and Running a Migration
    php artisan make:migration
    create_job_listings_table
edit generated migration file to define table schema
    then run php arisan migrate (apply migration to the table)

Populating the database
    records can be manually added using TablePlus or other DB clients
        eg add job listings with titles and salaries

### Notes
If you created an app without using 'laravel new' command
    You can use php artisan migrate
Going to delete the db to see this work.
    Well.. I'm going to back it up somewhere (out of pure fear)
added :fresh to the end, unsure what happened but all is well.
Downloaded tableplus > db management gui
    Easy to set up, all I had to do was know the filepath for the db
        /database/database.sqlite (this project)

Checked out the migrations dir under /database
    long file names as they incl the timestamp
Migrations great for sharing code with teammates.
    NEVER RUN php migrate: refresh in production (this drops a lot of data)
Migrate rollback - latest or most recent migration
    could have migrations to make, drop tables
        or add/rm columns... they can be actions that can be performed on a db

If things dont update in tableplus
    try to close and load up the connection again.

Making my own migration
php artisan make:migration
give a suitable name for the action to be taken
check out the file and add whatever you need for the Up/Down methods
    Up = changes
    down = reversions? is that a word... what to do to rollback
Now all you need to do is migrate... nothing appended to the end
        
        In cmd: output:
            INFO  Running migrations.

            2025_11_20_202415_create_job_listings_table ...................................................... 6.47ms DONE

There seems to be a paywall now with the tableplus app... I'm under the free version which wont let me check out a table I just added during a migration.
May have to stick to a vscode extension.
Really sad about that... I liked the gui of tableplus
but forking out 99 dollar right now is not at the top of my priority list.
shame.

UPDATE:
I am dumb as hell.
There are tabs in tableplus... you just have a limit of 3 tabs open at any given time : e.g. tables

## Ep 9 - Meet Eloquent (19mins)

### Quick Summary
#### Outline
Eloqent = 1 core pillar of laravel
= ORM (object relational mapper)
Maps DB rows to PHP objects - makes it easier to work with data via OOP
Example: instead of manually handling an array of job listings
    You can have a Job object representing each record with all attributes and behaviours.
        On the lines of
            Job.id ... Job.salary
            Job.Change_salary() ... Job.Add_Inflation()

#### Additional points
KEY POINTS (to look out for)
    extends Model
    all()
    find()
    protected
    ::create
    $fillable
    php artisan tinker
    php artisan make:model {modelName} -m

#### Homework
HOMEWORK (adding now to keep in mind as I study)
    Generate models and migrations
    Run migrations and use Tinker to interact with records
        get comfortable with commands and concepts
            They will show up a lot!

### Notes
#### Converting Your Job Class to an Eloquent Model
Convert existing Job class into an eloquent model
    rm hardcoded job listings array (data now from db)
    make class extend Larabels base Model class
        class Job extends Model
    (this gives class access to eloquents querying methods such as all() and find())

#### Working with Eloquent in Routes
In routes file, use eloquent methods to fetch data
    Your routes file is web.php
Example:
    $jobs = Job::all();
    dd($jobs)
Remember!
    You must add a using at the top
        use App\Models\Job;

If there is an empty collection,
    Check db table name matches eloquents convensions
    MUST BE plural_snake_case of the models name
        jobs >>> for Job
NOTE: IF table has a different name, you can specify in the model
    protected $table = 'job_listings'

#### Inspecting Eloquent Collections
Eloquent returns a collection of model instances
    each item is an instance of the model class
        you can add methods and behaviours directly to the model!
    You can also access arrtibutes
    EXAMPLE:
        ```$jobs[0] -> title;```
            accesses the title of the first job

#### Using Eloquent to Retrieve Records
Retrieve all records with all()
Or find specific record by ID with find()
```$job = Job::find(1);```
Eloquent runs sql queries in the background (but you interact with a clean expressive api)

#### Creating Records with Eloquent and Mass Assignment Protection
create new record with create() method
``` 
Job::create([
    'title' => 'Acme Director',
    'salary' => '1000000',
]); 
```
Laravel protects against
    mass assignment vulnerabilities
        by requiring you to specify which attributes are mass assignable in the the model
    This prevents malicious users from modifying unintended fields.

#### Using Tinker for Interactive Testing
Tinker = REPL (interactive shell) for the app
```php artisan tinker```
Used to test eloquent queries, create records, updt data

#### Generating Models and Migrations
Can gen models and corresponding migrations using artisan
```php artisan make:model Post -m```
Creates a Post model + migration file to define its db table
Migrations allow to define and modify db schema in php
    used to vers control and share with team.

### Additional notes
ORM - object relational mapper
    maps rows to objects
        single record being represented in code
(may be known as an active record)

Laravel and Eloquent rely on conventions over configuration!
after a dd() for an eloquent model class
    you can click on an instance (row) then check out attributes
        to see its data
Can index too like you normally would ```jobs[0]```
To grab one value, use the following
```jobs[0]->salary```
Note: you dont need quotes for attribute names

command line playground for the laravel app
    check for expected results
    get variables, manipulate things
        place to see what functions turned out to do
php artisan tinker
tried to use: ```> App\Models\Job::create(['title'=>'New Gen Developer', 'salary'=>'£68,000']);```
GOT AN ERROR!
    mass assignment exception
        laravels security > They tell you not to assign attributes all in one go like that!
        they keep you in line to avoid issues/ accidents
    NOTE:
        to protect problems with the end user!
            You have to assume theyre going to do something wrong!
                they can sneak in other attributes!
    But the workaround is literally in that error message...
    ```Add [title] to fillable property```

NOTE: I may need to fix issues with the pager:
    fix the PsySH pager
    Not getting expected outputs in tinker... it still works but not the format that i want
A work around for now is using dd()
    but this is not ideal
Tried to give it a go on different terminals in vscode but still got an issue.

I've been trying to tackle this for a while now.
crying > not literally but i sure as hell feel like it osifhiaosonmfcoiuhemosiacf

Also tried to use git bash to sort out a php file in C:\Users\david\AppData\Roaming\PsySH
I got it, set the code in there but still to noooooooo avail

Will I be using tinker often?
Yeah probably...
Will have to just deal with the workarounds...
dd() that \*\*\*\*\* :)

Top tip
use help before any given command to see extra info
but like so
``` php artisan help make:model ```
it will show you arguments required, options, 
using -a on the end may be useful, find out what this means

-m will create a corresponding migration

## Ep 10 - Model Factories
### Quick summary
Factories- essential for generating quick fake data within the DB
    useful for testing and local dev
Artisan tinker used to create and test factory data
gen factories with artisan commands  + define using Faker
Factories handle relationships by referencing other factories
States allow creation of variations of models for specific scenatios

### Quick pre-checks
Going to try to use codespaces to see if the tinker issues lift.
composer install
php: /lib/x86_64-linux-gnu/libcrypto.so.1.1: version `OPENSSL_1_1_1' not found (required by php)
Tried to sort this out but it failed.
    dev container built with corresponding json file, rebuilt container... nothing. A HEAD SCRATCHER THIS ONE.
reverted to last git changes

NOTE: just add a ->toArray() on the end to see more info such as the attributes
Example code
```App\Models\Job::all()->toArray()```

### Recap
Going to quickly recap on yesterday.

Created a new model - with corresponding migration file.
```
php artisan make:model MatchPlay -m
```

Amended the migration file
```
        Schema::create('match_plays', function (Blueprint $table) {
            $table->id();
            $table->string('home_team');
            $table->string('away_team');
            $table->string('location');
            $table->date('match_date');
            $table->integer('home_team_score')
            $table->integer('away_team_score')
            $table->timestamps();
        });
```

Amended the model to deal with mass exception (fillable variable overriden(?) here)
```
    protected $fillable = [
        'home_team',
        'away_team',
        'location',
        'match_date',
        'home_team_score',
        'away_team_score'
    ];
```

Added a row to the db table (initially didnt work but I just needed to set some attributes to nullable in the migration)
```
> App\Models\MatchPlay::create(['home_team'=>'Runcorn', 'away_team'=>'Warrington', 'location'=>'The heath school', 'match_dat
e'=>'2025-11-21']);
```


Checked out the added item
```
> App\Models\MatchPlay::all()->toArray()
= [
    [
      "id" => 1,
      "home_team" => "Runcorn",
      "away_team" => "Warrington",
      "location" => "The heath school",
      "match_date" => "2025-11-21",
      "home_team_score" => null,
      "away_team_score" => null,
      "created_at" => "2025-11-21T16:53:32.000000Z",
      "updated_at" => "2025-11-21T16:53:32.000000Z",
    ],
  ]
```

Made changes to that match data in TABLEPLUS to add score.
And then pushed changes.
sql updated successfully in vscode too
Will run the commands again to see this in tinker - get used to it

### Notes
#### Using Factories with Tinker
php artisan tinker.
Create user with factory
`User::factory()->create();`
NOTE: if errors with missing cols, check schema matches factory attributes
    example: if renamed name to FirstName and LastName etc.
Update the factory accordingly.
`'firstName' => $this->faker->firstName(),`
`'lastName' => $this->faker->lastName(),`
MUST restart tinker after changes.

#### Creating Multiple Records
example
`User::factory()->count(100)->create();`
This quickly generates 100 fake users

#### Creating a Factory for Job Listings
Instead of duping user factory, gen a new factory for the Job Model 
`php artisan make:factory JobFactory --model=Job`
In this JobFactory: define attributes such as title and salary.
Fakers methods such as jobTitle for realistic data (values can be hardcoded)
```
public function definition()
{
    return [
        'title' => $this->faker->jobTitle(),
        'salary' => $this->faker->numberBetween(30000, 100000),
    ];
}
```

#### Using Factories with Relationships
If job model belongs to an employer - define relationship in factory by creating an employer factory + reference this.
`'employer_id' => Employer::factory(),`
Tells laravel: create new employer record when generating a job + associate accordingly.
If there are errors:
    e.g. Employer factory not found
    generate the factory and make sure you add HasFactory trait to the model

#### Factory States
Represent different variations of a model
Example: UserFactory has a unverified state (sets emailVerifiedAt to Null)
```
public function unverified()
{
    return $this->state(fn (array $attributes) => [
        'email_verified_at' => null,
    ]);
}
```
Can create a new user in this state:
`User::factory()->unverified()->create();`
Own states can be defined such as 'admin' state (for users with admin priveledges) > Very useful.

### Additional
Factory used to scaffold or generate things like users.
    Great for testing.
    Quick generation
        Especially when generating a f-tonne of objects in a model.

Tried to run App\Models\User::factory()->create()
This came back with an error!
```
> App\Models\User::factory()->create()

   Illuminate\Database\QueryException  SQLSTATE[HY000]: General error: 1 table users has no column named name (Connection: sqlite, SQL: insert into "users" ("name", "email", "email_verified_at", "password", "remember_token", "updated_at", "created_at") values (Connor Luettgen, elvera83@example.com, 2025-11-21 17:43:14, $2y$12$5iHBkNE1l/5B1ZmCwkHLnOBH2nY8DAztTG.lDM2PSOMjdEi3SyrtO, j7w1yP4q5B, 2025-11-21 17:43:15, 2025-11-21 17:43:15)).
```
What does this mean? No column named name...
Well, we tweaked the name to have two attributes instead: firstname and lastname.
Checl tableplus to see (structure)

Within the UserFactory, you will see a fake() function
    this makes use of an api call to Faker (incudes methods for fake data)
There is already a method you can use from it!
`'first_name' => fake()->firstName(),`

NOTE: Trying to run the following code again will fail!
`App\Models\User::factory()->create()`
Why- when running tinker, all the code is loaded into memory... You need to exit out and run tinker again.

Restarted tinker and tried again... IT worked!!!

Well now you may want MANY records of fake data.
Run the same command but add an integer in the factory brackets
`App\Models\User::factory(100)->create()`

IF YOU NEED ASSISTANCE
do not type php artisan make:factory help
Stick the help before the make:factory.

Made a factory for jobs
`php artisan make:factory JobFactory`
Ran tinker + tried to create one
`App\Models\Job::factory()->create();`
BADMETHODCALL exceptoin!
Called to undefined method...
check Job model...
Since we manually created this model, it didnt including a using statment:
`use hasFactory`

Managed to create a user which implements a method Unverified (using a chain of commands)
`App\Models\User::factory()->Unverified()->create()`
Discussed state methods
Set one up for admin - commented this section out for now.

Created a new model called Employer (with migrations)
in the job listings migration - added `$table->foreignId(App\Models\Employer::class);`
running `php artisan migrate:fresh`
You will lose all seed data (from the factory? via tinker.)
    This is fine as that was only for testing purposes.

Now try to create a bunch of jobs... it should fault.
`php artisan tinker`
`App\Models\Job::factory(50)->create()`
It does not work bc employer id was not provided! >> So update job factory.

So i added to the JobFactory file
in the definition function
`employer_id' => Employer::factory()`
But it still fails... employer factory not found

When we were making the model, we could use -m for an appended migration
But we can also use -f for a corresponding factory.
Going to delete the Employer.php model for now then redo this !

ISSUE arose
`$table->foreignId(Employer::class);`
I needed to use foreignIdFor... needs the For appended there!
Better code:
`$table->foreignIdFor(Employer::class);`

Theres a method called recycle when simulating cross table data via the factory.

### Next up

We focused on DB stuff today
    Will move to how we can manage this on the eloquent end.
        IF we have a job- how do we fetch the employers name for that listing.

## Ep 11 - Two Key Eloquent Relationship Types (7m47s)

### Quick Summary
Eloquent relationships - feature that lets you define how models relate to one another.

Define relationships with methods such as belongsTo and hasMany.

Access related models as properties
    Triggers lazy loading.

Two relationship types cover most use cases.

More complex relationships such as belongsToMany and polymorphic relations will be covered at a later time!

### Pre notes

#### Defining Relationships Between Models
Prev established job listings belong to an emplpyer.
    Whilst db schema reflects this with a FK - PHP code needs to express this relationship also!

Within Job model
    Define an employer Method > returns the relatinship
```
public function employer()
{
    return $this->belongsTo(Employer::class);
}
```
This tells Eloquent: each job belonds to ONE employer.

#### Relationship Types
Common Eloquent relationships:
    belongsTo (1-1 or Many)
    hasMany (1-M)
    hasOne
    belongsToMany
Focus for today = belongsTo and hasMany.

#### Accessing Related Models
Artisan tinker again! yipeee.
Fetch a job and access employer via following code:
```
$job = App\Models\Job::first();
$employer = $job->employer; // Access as a property, not a method so no brackets on the end.
```
Eloquent uses lazy loading
    related employer data only fetched when you access the employer property (triggers a seperate SQL query)

#### Defining the Reverse Relationship
In the employer model (define the inverse relationship)
```
public function jobs()
{
    return $this->hasMany(Job::class);
}
```

This allows you to get all jobs for a given employer:
```
$employer = App\Models\Employer::first();
$jobs = $employer->jobs; // Returns a collection of Job models
```
Eloquent collections behave like arrays.
    But include helpful methods for filtering and manipulation.

### Workthrough notes:
assigned a job variable in tinker via
`$job = App\Model\Job::first();`
This was just the first item in the array.
Used the following code to see the employer information
`$job->employer;`
The reason there was no brackets on the end was because we are trying to access a property instead
Laravel can see that there is no employer property
    so it will try to use the employer relationship instead!
        Makes things easier.
You can then access the employers methods too such as filtering down for the name
`$job->employer->name;`

Note: lazy loading is used.
    Query is not being executed until the last possible minute.
        A new SQL query may include
            Select all from employers where employerID = 2
                just an example.

Try the same the other way around?
    See what a particaular employerhas in temrs of jobs.
    Not possible yet
    WHY?
        Well we havent written the relational code for it yet.

Check into the Employer.php file in Models.

Day 11 was bl**dy short!

### Homework
Get this into muscle memory, play with it.
Use the relationships between posts and comments perhaps?!
    One post has many comments
    one comment belongs to one post.
    One user may make many posts.
    Many posts may have many tags - perhaps.
        This one will be covered in day 12

Homework copied:
```
Practice defining hasMany and belongsTo relationships using examples like posts and comments, or posts and users. Experiment with accessing related models and understand how Eloquent handles these relationships.

See you in day twelve!
```

So note: if you set up migrations where a child has a fk to a parent.
Then when you write up the factory stuff, you should ideally pull up the FK's from the parent model.
    It was mentioned that there is a recycle method? To reuse the same parents every now and then... So it doesnt just run through the id's one by one.

## Ep 12 - Pivot Tables and BelongsToMany Relationships (14m23s)
### Quick Summary
Focus = create many to many relationships
    between jobs and tags using pivot table + eloquent belongsToMany relationship

### Quick HW (to keep at forefront of mind)
Practice creating many to many relationships
    between posts and tags in a blog
1. Create posts and tags tables
2. Create a pivot table post_tag
3. Define belongsToMany relationships in the Post and Tag models
4. Experiment with attaching tags to posts and retrieving related data.

### Pre Notes
#### Setting Up the Tag Model and Migration
Generate the Tag model with migration and factory
`php artisan make:model Tag -mf`
Within the migration file, define the tags table with a name attribute.

#### Creating the Pivot Table
To connect jobs and tags: create a pivot table (named by combining the singular forms of the related tables in alph order >> eg. job_tag)

The pivot table should incl foreign ID attributes for both job_listing_id and tag_id

```
$table->foreignId('job_listing_id')->constrained()->cascadeOnDelete();
$table->foreignId('tag_id')->constrained()->cascadeOnDelete();
$table->timestamps();
```
Since jobs table is named job_listings > YOU MUST specify the FK column as job_listing_id to avoid conflicts

#### Enforcing Foreign Key Constraints
Add constraints with cascading deletes to ensure that deleting a job or tag REMOVES related pivot records (preventing orphaned records)

If using SQLite directly - may need to enable foreign key constraints manually w/ `PRAGMA foreign_keys = ON;`
Laravel usually enables this by defualt in the app.

#### Defining the Many-to-Many Relationship in Models
In Job model, define tags:
```
public function tags()
{
    return $this->belongsToMany(Tag::class, 'job_tag', 'job_listing_id', 'tag_id');
}
```

In the Tag model, define inverse jobs method:
```
public function jobs()
{
    return $this->belongsToMany(Job::class, 'job_tag', 'tag_id', 'job_listing_id');
}
```

specify pivot table name and FK attributes explicitaly.
Because your table names differ from Laravels conventions.

#### Using the Relationship
Access tags for a job:
```
$job = Job::find(10);
$tags = $job->tags; // Returns a collection of Tag models
```

Or access jobs for a tag:
```
$tag = Tag::find(1);
$jobs = $tag->jobs; // Returns a collection of Job models
```

#### Attaching and Detaching Related Models
Attach a tag to a job
`$tag->jobs()->attach($jobId)`
When accessing the relationship as a property, you get a cached collection.
To refresh and get latest data:
    Call the relationship as a method with get()
`$tag->jobs()->get();`

### Practical Notes
could create a brand new mgration for pivot tables
Or you can just append another schema::create in the same migration as a related table.

Added the following to the tags migration
```
        Schema::create('job_tag', function (Blueprint $table) {
            $table->id();
            // going to overwrite the foreign names to match the models
            $table->foreignIdFor(Job::class, 'job_listing_id');
            $table->foreignIdFor(Tag::class);
            $table->timestamps();
        });
```

Going to add a foreign constraint
```
$table->foreignIdFor(Job::class, 'job_listing_id')->constrained()->cascadeOnDelete();
$table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
```
Note: ensure you have functionality to drop the pivot table aswell.
`Schema::dropIfExists('job_tag');`
Can run multiple artisan commands in the cmd with the && operator
`php artisan migrate:rollback && php artisan migrate:fresh`

Alright added the constraint but it didnt seem to constrain anything - WHY
default for sqlite is that constraints are not enforced
but in laravel app, they are enforced.
    So when in db delete, and wanting constraints to take effect, we have to set this up manually.

Go back to TablePlus
    SQL tab
    Run PRAGMA foreign_keys=on

    RUNNING INTO ISSUES HERE
    ROUGHLY AROUND THE 6 MINUTE MARK.

DATE: 22/11/2025
Alright so I think the issue was that i needed to run that sql command first, then run the rollback migrations + migrate.
All is working now.
There will be no orphaned entries in the pivot table!

Set up belongs to many relationships in the models for job and tags
```
    public function jobs() {
        return $this->belongsToMany(Job::class);
    }
```
And
```
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
```

Returned an error when i tried to run:
```
$job = App\Models\Job::find(1)
$job->tags
```
ERROR =
```
   Illuminate\Database\QueryException  SQLSTATE[HY000]: General error: 1 no such column: job_tag.job_id (Connection: sqlite, SQL: select "tags".*, "job_tag"."job_id" as "pivot_job_id", "job_tag"."tag_id" as "pivot_tag_id" from "tags" inner join "job_tag" on "tags"."id" = "job_tag"."tag_id" where "job_tag"."job_id" = 1).
```
WHY?
expecting a col name of job id... we got job_listing id instead!
You must specify, be explicit.

used named arguments (this means you dont need to use arguments in a specific order)

surronding attach
Managed to attach a job to a tag using the following code
```
$tag = App\..yidayada.. ::find(1)
$tag->jobs()->attach(7)

// 7 is the id
// Can also use the following

$tag->jobs()->attach(App\Models\Job::find(7))
```

You may still only see one item when you try to see them again.

Can refetch the tag and start over, or just run `$tag->jobs()>get()`

You can also append the pluck('attributeName')
To grab specific attributes.
`$tag->jobs()>get()->pluck()`

### Going to continue with HW next
```
Practice creating a many-to-many relationship between posts and tags in a blog example:

Create posts and tags tables.
Create a pivot table post_tag.
Define belongsToMany relationships in the Post and Tag models.
Experiment with attaching tags to posts and retrieving related data.
```

Made a different migration for this called 2025_11_22_215054_create_post_tag_table
the command used was:
`php artisan make:migration create_post_tag_table --create=post_tag`

Dont forget the using statements david!
Was nice to pick up on an error and get to work immediately though. I'm feeling a benefit from the history of hiccups.
    It's... satisfying.
        bittersween process, in that order.

Oh man the factory commands feel easy to use now too.. !

Checking get() and pluck() functions:
    picked out the first tag entry
    then used the following code:
    `$tag->posts()->get()->pluck('title','content')->toArray()`
    RESPONSE:
    `["this is some content for my post" => "my post"]`
    Now... I thought this would produce the title first then give me the content after...
    But it shows the content first then the title...

Need to try attach to finish off the hw
tried to use tag-jobs-attach(5)
```
> $tag->jobs()->attach(5)

   Illuminate\Database\QueryException  SQLSTATE[23000]: Integrity constraint violation: 19 FOREIGN KEY constraint failed (Connection: sqlite, SQL: insert into "job_tag" ("job_listing_id", "tag_id") values (5, 1)).
```
I must be tired... I'm working with posts and tags... not jobs.

New:
```
> $tag->posts()->get()->pluck('title','content')->toArray()
= [
    "Officiis molestiae cupiditate corrupti sit sed eligendi sit. Veritatis et quis facere voluptatem eaque. Et distinctio quis in non." => "Sit nihil fugit deserunt deserunt rerum facere voluptatem possimus.",
  ]
```

## Ep 13 - Eager Loading and the N+1 Problem (10m33s)
Little note: I feel dreadful.
If you see this in the future, Dave.
It was worth it.
keep going man.
Take a rest tomorrow, get creative with the PP module.

### Quick Summary
Tackling n+1 problem in eloquent relationships - learning how to optimise db queries with eager loading.

n+1 problem causes excessive queries when lazy loading relationships in loops.
Laravel debugbar can detect query counts.
Fix n+1 by eager loading relationships with with()
Optionally disable lazy loading in development to catch issues early.

### Pre Notes
#### Improving Job Listings Display
We updated jobs view to display each job as clickable card
    using anchor tags styled with tailwind.
    Added padding, borders, spacing, rounded corners.
Also displayed employers name above each job title
    by accessing employer relationship on the job model

#### Understanding the N+1 Problem
When lazy loading relationships inside a loop
    one query to fetch main records
        one additional query per related record
results in many queries - poor performance

EG: fetching 8 jobs and their employers takes 9 queries.
    1 for jobs, 8 for employers.

#### Detecting the N+1 Problem
Detect with tool: laravel debugbar
    shows all sql queries executed during requests.

install with composer
`composer require barryvdh/laravel-debugbar --dev`
Ensure APP_DEBUG set to true (.env)
    this enables debugbar

#### Fixing the N+1 Problem with Eager Loading
Eager loading= fetches related models in single query upfront!
    This reduces the number of queries.

modify query to eager load employer relationship
    `$jobs = Job::with('employer')->get();`
This executes 2 queries regarding num of jobs
    one for jobs, one for employers

#### Optional: Disabling Lazy Loading
Disable entirely = catches unintended queries
    Do this in AppServiceProvider

```
use Illuminate\Database\Eloquent\Model;

public function boot()
{
    Model::preventLazyLoading(!app()->isProduction());
}
```
This throws an exception whenever lazy loading occurs.
    That, is a good thing.

### Practical Notes
Installed debugbar
searched for it online
looked into readme docs

all i had to do was run composer require barryvdh/laravel-debugbar --dev
Then refresh the website
The bar showed underneith

Refreshed jobs page
selected Queries on debugbar

A DEAD GIVEAWAY for lazy loading
seeing the same line repeated OVER AND OVER AND OVER
select * from "employers" where "employers"."id" = 1 limit 1
select * from "employers" where "employers"."id" = 2 limit 1
...
And so forth

8 records: 8 queries.
For every record, we plus 1 to the query.
Lazy loading CAN be helpful, but performance issues will sneak their ways in

eager loading placed in the routes file.
`$jobs = Job::with('employer')->get();`
Pagination disgussed next session.

app\Providers\AppServiceProvider.php
In here you can configure the app to disable lazy loading.
Some devs do this at the start of each project - I might follow suit.
Enforces a specific set a rules when programming. I don't want to switch between two styles.
I'm sure there must be something as a drawback to eager loading... But lets stick to this.

```
    public function boot(): void
    {
        Model::preventLazyLoading();
    }
```

This will now result in an exception thrown.
`Illuminate\Database\LazyLoadingViolationException`

No Homework.

## Ep 14 All You Need to Know About Pagination (13m6s)
### Quick Summary
Manage large datasets: fetches and displays records in smaller chunks
    instead of all at once
WHY?
    Fetching thousands of records all at once can overwhelm the server + browser.
    Pagnation limits num of records retrieved and displayed per-page.
    ++ performance
    ++ UX

Laravel makes pagnation easy with built in methods + blade helpers.
Customise pagnation views or switch css frameworks
Choose between standard simple or cursor pagination based on needs.

### Pre notes

#### Implementing Pagination
Replace query with so:
`$jobs = Job::with('employer')->paginate(3);`
This fetches 3 jobs per page along with employers.

#### Displaying Pagination Links
In blade view - render pagination links with:
`{{$jobs->links()}}`
Laravel auto gens styled pagination controls
    Assuming you use Tailwind css by def'lt

#### Customizing Pagination Views
Customise pagination markup or use different css framework (bootstrap eg)
Publish the pagination views with:
    `php artisan vendor:publish --tag=laravel-pagination`

This copies pag' views into resources\views\vendor\pagination dir' for editing.

To switch def'lt pag view (eg to boostrap), config this in AppServiceProvider

```
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::useBootstrapFive();
}
```

#### Pagination Types
STANDARD = shows page nums and nav links
SIMPLE = shows only prev and next links (reduce query complexity)
CURSOR = cursor (encoded string) for efficient pag' on LARGE datasets
    This does however lack direct page num navigation.

SIMPLE example.
`$jobs = Job::with('employer')->simplePaginate(3)`
CURSOR example
`$jobs = Job::with('employer')->cursorPaginate(3);`

#### How Pagination Queries Work
STANDARD uses SQL LIMIT and OFFSET: to fetch correct subset of records.
CURSOR pag' uses encoded cursor: fetch records after a certain point.
    This avoids performance cost of large offsets.

### Practical Notes
Amended a line with `$jobs = Job::with('employer')->paginate(3);` in the routes file.

Checked the website, it worked! But where is the rest of it??
Well, You can find this by appending a `?page=2` on the url
Probably will check out how to make this more accessible to the user.

This must be done in the blade template (i.e. jobs.blade.php in this case)

Looks good! - laravel assumes you are using tailwind - formatting is already set up here!

Custom libraries- diff from tailwind
This is how:
`php artisan vendor:publish `
vendor- any package pulled with composer
publish- publish relevent assets, routes, files, views >> to application folder
    to manually control and edit them!

Q: Where is the markup for these pagnation links!
need to publish them so we can manually edit the files.

Little bit of problem solving
when using publish, i needed to enter the number of the line associated with the thing im publishing
So laravel-pagination was actually no16 in this case.
Vendor folder now showing in the views dir.

CHANGE from tailwind to bootstrap for example:
    AppServiceProvider

To make tweaks to tailwind paginator: go to: 
`resources\views\vendor\pagination\tailwind.blade.php`

There is currently a performance cost when displaying pagination in this way.
If you have millions of records, it can be costly to calc how many pages you need and render them

If displaying page 392 for example, it could be costly.
Look at simple or cursor pagination.

Swap paginate with simplepaginate.
can also use cursor painate

cursor may be good for infinate scrolls and large datasets where you dont need to use manually entered url.

THIS IS 95% of what you need to know right now!

Backup of code
```
    // $jobs = Job::with('employer')->simplePaginate(3);
    // just has a prev and next button. This is fine unless a user really wants to jump pages.

    // $jobs = Job::with('employer')->cursorPaginate(3);
    // if you hover over the next button, the url will have a cursor value... this is random asf
        // you drop the ability to jump to specific pages, but its more efficient for large datasets
        // good for infinite scrolls

    $jobs = Job::with('employer')->simplePaginate(3);
```

## Ep 15 Understanding Database Seeders (7m 49s)

### Quick summary
Automate populating db with test or initial data.
Use `php artisan db:seed` to run seeders
Combine migrations and seeding with `migrate:fresh --seed`
    We used this in class.
Factories gen fake data efficiently with seeders.
Split seeders for modular and flexible data setup

### Pre Notes
#### Why Use Database Seeders?
after ` php artisan migrate:freshg`
DB tables recreated but empty!!!
    Manually inserting data is tediuous (here, here.)
Seeders automate process.

#### Seeders in Laravel
Check database/seeders dir.
Default DatabaseSeeder class is entry point > to run multiple seeders.

To run seeders use:
    `php artisan db:seed`

#### Creating and Running Seeders
If there are errors like missing cols, ensure seeders and factories match your DB schema.

Combine migration and seeding in one command:
`php artisan migrate:fresh --seed`
This drops all tables, runs migrations, and then seeds.

#### Using Factories in Seeders
To gen large data quickly.
`\App\Models\Job::factory(200)->create();`

#### Splitting Seeders for Flexibility
Create multiple seeder classes for diff parts of your DB
`php artisan make:seeder JobSeeder`
This lets you run seeders individually, or in groups.
    Good for testing/ partial data refreshes

In DatabaseSeeder: call other seeders.
```
public function run()
{
    $this->call([
        UserSeeder::class,
        JobSeeder::class,
    ]);
}
```

### Practical Notes
when running php artisan migrate:fresh... It wipes everything!
Its tough on the mentals to populate tables with manual factory code again and again.

tried to run php artisan db:seed... fail
WHY
Well, we need to make sure the seeder and factory match the db schema..
Here, our users were amended to have 2 attributes for first and last name, rather than just name.
So change the code in the seeder file.

Now use `php artisan migrate:fresh --seed`
indicates that the seed task will be re-run.
You cannot use -s !!

running php artisan db:seed AGAIN..
FAILED!
WHY
We tried to add the same user that already exists... but one of the attributes states that it must be unique.
So avoid this problem with php artisan migrate:fresh --seed !!

Creating a new seeder class with
`php artisan make:seeder`
Good for isolating tests later.
Stick to this practice!!

In the DADDY seeder, yes i will call it that.
You can use the following to call other seeders.
`$this->call(JobSeeder::class);`

Can exclusively run one seeder instead
`php artisan db:seed --class=JobSeeder`

On to forms next :)

## Ep 16 Forms and CSRF Explained (with Examples) (23m 52s)
Bit of a chunky episode! (relative)

### Quick Summary
Forms: converting request data handling, 
    organising folders,
    Cross site request forgery (CSRF) protection.

Define specific routes before wildcard routes
    avoids conflicts
Organise views in resource-specific folders 
    (w/ conventional names)
Tailwind ui comps to build forms quickly
Set form method to POST
    include a csrf token wiht @csrf
Access request data via request() helper
Eloquent to create new records safely
    (with mass assignment protection!)
Redirect users after successful form submits.

### Pre Notes
#### Defining Routes for Forms
When adding a route for creating a new job
    use the URI jobs/create
Stay aware of the route order!!
    wildcard routes like job/{id} should come after specific routes like jobs/create...
        otherwise we get conflicts!

"job... what job??"

#### Organizing Views
Group related views in folders
    e.g. place for all job related views in a jobs dir
use common naming convensions
    ```
        index.blade.php for listing all jobs
        show.blade.php for displaying a single job
        create.blade.php for the form to create a job
    ```
Use dot notation in views references
    e.g. 'jobs.create'

#### Building the Form
Tailwind form template
    trimming unnecesarry sections
    adjust input fields to match db attributes
        title, salary
    add placeholders
    include padding for better UX

#### Handling Form Submission
Forms submit via GET to themselves.. by def
    change method to POST
        set action to /jobs - follows RESTful conventions for creating resources.
    Add a POST route for /jobs in routes file (web.php) 
        (to handle form submissions)

#### CSRF Protection
Laravel protects against CSRF attacks by req a token in the POST requests.
    add blade directive @csrf inside form
        this is a hidden token input
Without this you get a 419 error!
    page expired.

#### Accessing Request Data
use request() helper to retrieve form data
```
$request->all(); // all form data
$request->input('title'); // specific field
```

#### Creating Records
Create new job record with eloquents create() method 
    (with request data)
```
Job::create([
    'title' => $request->input('title'),
    'salary' => $request->input('salary'),
    'employer_id' => $employerId, // typically from authenticated user
]);
```

include employer_id in modules $fillable array
    or disable mass assignment protection accordingly.

#### Redirecting After Submission
After creating a Job
    redirect user back to job listings page
`return redirect('/jobs');`

### Practical Notes
Tried to add the following to test jobs/create.
```
Route::get('/jobs/create', function(){
    dd('hello');
});
```
Result:
ErrorException
resources\views\job.blade.php:7
Trying to access array offset on null

WHY
Notice we have a wildcard declared abvove this!
    This listens to a request for jobs/ANYTHING (id)
        this includes create, which was made after this route... so leave the wildcards to the bottom
COMMON ISSUE

MOVED THIS> success.

creating a dir called `jobs` in the views folder to collect job related resources.
Think of this like namespace... Maybe that's just complicated it more.
File structure.
organise that.

renamed jobs.blade.php to `index.blade.php`
many files can have the same name as long as theyre in diff dir's
This us usually where EVERYTHING is shown.

Will amend job.blade.php to `show.blade.php`
This is for singular items...
"Show me this one pokemon in your pokemon index."

Additionally, you would have a create view for creating a task.
`create.blade.php`

Now need to amend the routes file to suit this.
    `return view('jobs.index', [`
You can also use `jobs/index` but the dot notation is more common.

Onto Tailwindui.com >> Going to grab a form template from here.

QUICK NOTE:
Some things wont look quite right.
tailwindui is not compatible with the latest vers of tailwind.
```
C:\Users\david\Herd\example>npm list tailwindcss
example@ C:\Users\david\Herd\example
├─┬ @tailwindcss/vite@4.1.17
│ ├─┬ @tailwindcss/node@4.1.17
│ │ └── tailwindcss@4.1.17 deduped
│ └── tailwindcss@4.1.17 deduped
└── tailwindcss@4.1.17
```

Anything 4.x will not work
can downgrade or change the code..
Right now this just concerns the UI.. functionality should remain the same.
    but be careful!

Form right now is blank
It's just making a get request to itself and passing the fields provided.

Recieved a 419 error, but no extra information right now
    framework could be more clear here. so pay attention for now
419 = laravel automatic csrf protection
    cross site request forgery !!

CODE USED
```
Route::post('/jobs', function () {
    dd(request()->all()); // dump and die - shows all the form data submitted
});
```

STORY TIME
Imagine you're an employer of a local bank
localbank.test
Theres a page when you sign in to update passw
Whats the problem?
Localbank does not know anything about security

A malicious person can take adv of the bank and you
they would send an email "representing the local bank"
They would ask you to update password and tell you to 'click here'

Users sent to a form to update pw
Submits it off
user does not know something went down

When they clicked that button, they didnt go back to localbank.test
instead it went to a malicious site that looks exactly like it.

When you submit the form on the malicous site, it sends a post request BACK to the localbank.test site...

If you were already logged in earlier in the day then you're still in the session
    you have cookies that say you're still signed in
malicious post request will be successful because of this.

Bandits have access to your pw
they can then log in to your account.

Token used - compares your local session token to the sites token
    if they do not match then it probes a 419 error.

`@csrf` blade directive can be added, first line after a form tag.
You can inspect, and at the top of the form it is present.
name= '_token'

Different ways to filter request.
```
    // dd(request()->all());
        // THIS INCLUDES THE CSRF TOKEN

    // dd(request()->except('_token'));
        // EXCLUDE THE CSRF TOKEN

    // dd(request()->only('title', 'salary'));
        // ONLY GET THESE FIELDS

    // dd(request('title'));
        // GET A SINGLE FIELD
```

Was wondering why it failed - 19min40s in...
It was meant to fail. Be patient David.

Guarded acts as a blacklist for fillable fields.
```
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
```

## Ep 17 - Always Validate. Never Trust The User (13m49s)

### Quick Summary
Validation in forms- client and server side validation.
    + Handling errors gracefully.

Add create btn + route for job creation
use @csrf - protect forms
Validate inputs server side w/ laravel validation
Display validation errors globally/ inline.
Enhance UX w/ client side validation
Create records safely - redirect after submission

### Pre Notes
#### Adding a Create Job Button
Make it easier: access job creation form
    Add a btn to redirect user
Tailwind css classes to style nicely 
    + postion with flexbox

`<a href="/jobs/create" class="your-tailwind-button-classes">Create Job</a>`
May be good to extract this into a reusable blade component. Learnt at the start of the module

#### Defining Routes for Form Submission
incl POST route > /jobs
    handles form submits
Initially add a simple sanity check
    with dd("hello from POST") >>> confirm route is hit

#### Understanding CSRF Protection
without csrf = 419 error
    Laravels protection against csrf attacks
Fix with `@csrf` inside form.
    injects hidden input with a unique token.

#### Accessing Request Data
request() helper >>> retrieves form inputs
```
$request->all(); // all inputs
$request->input('title'); // specific input
```

#### Server-Side Validation
Laravel has a built in validation tool
If it fails > auto redirects back with error msg
```
$request->validate([
    'title' => ['required', 'min:3'],
    'salary' => ['required'],
]);
```

#### Displaying Validation Errors
GLOBALLY:
```
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li class="text-red-500">{{ $error }}</li>
        @endforeach
    </ul>
@endif
```

Or display INLINE (below each input with @error directive)
```
@error('title')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror
```

#### Client-Side Validation
incl `required` attribute to inputs
    instant browser validation
enhances UX - they get instant feedback without being sent to a ERROR!-page

#### Creating Records and Redirecting
After validation > create record with eloquent.
```
Job::create([
    'title' => $request->input('title'),
    'salary' => $request->input('salary'),
    'employer_id' => $employerId, // typically from authenticated user
]);

return redirect('/jobs');
```
Include all mass assignable fields in models $fillable array
    OR disable this with guarded (prev lesson)

#### ADDITIONAL
No homework listed, but get used to what is going on.

### Practical Notes
```
Route::post('/jobs', function () {

    // validate the incoming request data >> So you don't have to do "required" in the HTML form
    // I feel like this is better practice.
    request()->validate([
        'title' => 'required',
        'salary' => 'required'
    ]);
```

You can also produce min/max here... how many chars.

when you use request()->validate()
laravel sorts out issues automatically.

Notice now... it failed.
The errors were included but nothing was displayed!

Return to create view

Example of inline validation:
   ```
                            @error('salary')
                                <div class="mt-2 text-sm text-red-600 font-semibold mt-1">{{ $message }}</div>
                            @enderror
```
This will only display if an error has occured with the input field relating to salary.

Can also add a `required` attribute to the input tags.
This is client side validation, instant feedback.

Check out `laravel.com/docs/validation`
Within the table of contects > theres a section for ALL VALIDATION RULES.

COMPLETED

## Ep 18 - Editing, Updating and Deleting a Resource (20m31s)
Chonky ep
### Quick Summary

Focus = editing, updating, deleting resources in Laravel.
Complete core CRUD operations for our jobs resource.

Add routes and views: editing and updating jobs.
Use PATCH for update,
use DELETE for deletion requests.
Validating input before updating.
Handle deletion with seperate form and button.
Complete CRUD cycle (Create read update delete).

### Pre Notes
#### Adding an Edit Button
Add an Edit Job button
    using reusable button component, that we already made.

Position and style appropriately.

#### Defining the Edit Route
Add GET route (editing job)

```
Route::get('/jobs/{id}/edit', function ($id) {
    // Return edit view with job data
});
```
Create edit.blade.php view
    similar to create form
pre-populate inputs with current job data

#### Updating a Job
Add PATCH route
    handle form submits for updates

```
Route::patch('/jobs/{id}', function (Request $request, $id) {
    $request->validate([
        'title' => 'required|min:3',
        'salary' => 'required',
    ]);

    $job = Job::findOrFail($id);
    $job->update([
        'title' => $request->input('title'),
        'salary' => $request->input('salary'),
    ]);

    return redirect("/jobs/{$id}");
});
```
Blades directive `@method('PATCH')`
    in form > spoofs http verb
    Since browser only support GET and POST

#### Deleting a Job
add DELETE route 
    to handle job deletion
```
Route::delete('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    $job->delete();

    return redirect('/jobs');
});
```
Since forms cant be nested
    create a seperate hidden form
        for deletion
    and link a button to sub,it it using the form attribute.

### Practical Notes

Added a route to update details
```
Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return View('jobs.edit', ['job' => $job]);
})->name('job');
```

Copied create.blade.php (jobs dir) and pasted in same place, renamed copy to edit.blade.php
Here, amended some ui
Cancel button sends user to the job page for that id again.
Need to sort out the submit button now.

Get - getting a page
post - common for submitting a form that stores data in db
Browser only supports these two natively.

Need to focus on other two
PATCH - update resource
DELETE - destroying resource

PATCH:
Exact same as show, but changed the method. So its completely different
```
// update (uses same uri as show, but different method)
Route::patch('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return View('jobs.show', ['job' => $job]);
})->name('job');
```

Can do the same for delete

Take out the code on the inside!

WARNING:
When using `$job = Job::find($id);`
If that id doesnt exist, it will return null.. which is fine until you try other operations on that..
Then it blows up!
    not literally, but imagine.
It is good practice to use `findOrFail` instead

Can shorten code down without creating seperate variables.. may save processing power/ mem
```
    // authorise request
    $job = Job::findOrFail($id);
    // delete job
    $job->delete();
```
TURNS INTO
```
Job::findOrFail($id)->delete();
```

BLADE DIRECTIVE to signal to laravel what request type we want
```
    <form method="POST" action="/jobs/{{ $job['id'] }}">
        @csrf
        @method('PATCH')
```
You need @method to do this

Set up button to delete
styling added so it appears to the left of cancel and submit.
Created a new form at the very bottom (hid this)
Needs to have an id appended
```
    <form id="delete-form" method="POST" action="/jobs/{{ $job['id'] }}" class="hidden">
        @csrf
        @method('DELETE')
        <!-- will sort this out in the routes file -->
    </form>
```
This id needs to correspond with a form attribute in the button
```
                <button form="delete-form" class="text-red-500 text-sm font-semibold">Delete</button>
```

AUTHENTICATION chapter will discuss issues rn
ANYONE can update or delete jobs... Not ideal for most/ nearly every scenario.

Essence of CRUD completed.

## Ep 19 - Routes Reloaded - 6 Essential Tips (16m 33s)

### Quick Summary 
Focus = improving routes file
Tips, techniques
Keep it clean, maintainable, efficient

### Pre Notes:
#### 1. Route Model Binding
Instead of manually fetching models by ID in route closures
    laravel can offer route model binding.
        this automatically injects model instances based on route parameters.

CHANGE this:
```
Route::get('/jobs/{id}', function ($id) {
    $job = Job::findOrFail($id);
    // ...
});
```
TO this:
```
Route::get('/jobs/{job}', function (Job $job) {
    // $job is automatically resolved by Laravel
});
```

KEY POINTS:
* route param name ({job}) MUST match variable name in the closure.
* Laravel uses the models PK (id = default) to fetch the record.
* Specify different column (slug) by adding `:slug` to the route param

UPDATE ALL routes to use route model binding
    for cleaner code

#### 2. Dedicated Controller Classes
LARGER APPLICATIONS
managing many routes with closures becomes a lot

Instead, use controller classes
    here you can organise route logic

Generate a controller
`php artisan make:controller JobController`

Move route logic in here like:
* index
* show
* create
* store
* edit
* update
* destroy

Update routes to reference controller actions
```
use App\Http\Controllers\JobController;

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
// etc.
```

#### 3. Route View Shortcut
For simple routes (only rtrn a view/ static pages)
Use `Route::view`
See example
`Route::view('/contact', 'contact');`
WHY?
This avoids creating unnecesassary closures/ controller methods

#### 4. Listing Routes
artisan can list all routes
`php artisan route:list`

Exclude vendor routes to focus on YOUR app routes
`php artisan route:list --except=vendor`
WHY
This assists with auditing and managing routes effectively

#### 5. Route Grouping with Controllers
REDUCES REPETITION
REDUCES REPETITION
REDUCES R... Alright you get it now.

Group the routes by controller
See code:
```
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    // other routes...
});
```
WHY
This cleans up routes file
    makes it easier to maintain.

#### 6. Route Resource
Laravel gives a method to register all standard resource routes
    all at once
`Route::resource('jobs', JobController::class);`

This registers routes for index, create, store, show, edit, update, destroy
    Following RESTful convenitions

Limit/exclude specific actions
See code:
```
Route::resource('jobs', JobController::class)->except(['edit']);
Route::resource('jobs', JobController::class)->only(['index', 'show', 'create', 'store']);
```

#### OUTLINE/ TIP
Practice these techniques often.
They will assist with building applications that are SCALABLE + MAINTAINABLE.

Will focus authentication NEXT episode!

### Practical Notes
```
Route::get('/jobs/{job}', function (Job $job) {
    return View('jobs.show', ['job' => $job]);
})->name('job');
```
Convention followed
Wildcard and function name = identical
added a type to the functions param...
Need to tell it you're passing an instance, not a string.
Since they match, the wildcard provides the ID

If they dont have an id... sayyyyy... posts.
They usually come with a slug.
So you will need to use `Route::get('/jobs/{job:slug}', function (Job $job) {`

php artisan make:controller
This allowed us to create a controller,
selected an empty type.
Looks like convention is to use the singularname
camelcase
`JobController` was used.

Note: 
index, show, create, update, delete, edit, store...
These are all `ACTIONS`.
NOT "METHODS"

```
Route::get('/', function () {
    return view('home');
})->name('home');
```
Can be shortened down to
```
Route::view('/', 'home')->name('home');
```
Since it just returns a view

To see all routes, use
`php artisan route:list`
NOTE: vendor routes will also be listed
You can filter with the following:
`php artisan route:list`

SEE before:
```
C:\Users\david\Herd\example>php artisan route:list     

  GET|HEAD   / .................................................................................... home
  POST       _boost/browser-logs .................................................... boost.browser-logs
  GET|HEAD   _debugbar/assets/javascript ... debugbar.assets.js › Barryvdh\Debugbar › AssetController@js
  GET|HEAD   _debugbar/assets/stylesheets debugbar.assets.css › Barryvdh\Debugbar › AssetController@css   
  DELETE     _debugbar/cache/{key}/{tags?} debugbar.cache.delete › Barryvdh\Debugbar › CacheController@…  
  GET|HEAD   _debugbar/clockwork/{id} debugbar.clockwork › Barryvdh\Debugbar › OpenHandlerController@cl…  
  GET|HEAD   _debugbar/open .... debugbar.openhandler › Barryvdh\Debugbar › OpenHandlerController@handle  
  POST       _debugbar/queries/explain debugbar.queries.explain › Barryvdh\Debugbar › QueriesController…  
  GET|HEAD   contact ........................................................................... contact  
  GET|HEAD   jobs ........................................................... jobs › JobController@index  
  POST       jobs ............................................................ job › JobController@store  
  GET|HEAD   jobs/create .................................................... job › JobController@create  
  GET|HEAD   jobs/{job} ....................................................... job › JobController@show  
  PATCH      jobs/{job} ..................................................... job › JobController@update  
  DELETE     jobs/{job} .................................................... job › JobController@destroy  
  GET|HEAD   jobs/{job}/edit .................................................. job › JobController@edit  
  GET|HEAD   storage/{path} .............................................................. storage.local  
  GET|HEAD   up ........................................................................................  

                                                                                     Showing [18] routes 
```

SEE AFTER:
```
GET|HEAD   / .................................................................................... home
  GET|HEAD   contact ........................................................................... contact  
  GET|HEAD   jobs ........................................................... jobs › JobController@index  
  POST       jobs ............................................................ job › JobController@store  
  GET|HEAD   jobs/create .................................................... job › JobController@create  
  GET|HEAD   jobs/{job} ....................................................... job › JobController@show  
  PATCH      jobs/{job} ..................................................... job › JobController@update  
  DELETE     jobs/{job} .................................................... job › JobController@destroy  
  GET|HEAD   jobs/{job}/edit .................................................. job › JobController@edit  

                                                                                      Showing [9] routes  
```

TIP:
To avoid repeating the controller name, over and over and over
and over..

Use the following code
```
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('jobs.index');
    Route::get('/jobs/create', 'create')->name('jobs.create');
    Route::get('/jobs/{job}', 'show')->name('jobs.show');
    Route::post('/jobs', 'store')->name('jobs.store');
    Route::get('/jobs/{job}/edit', 'edit')->name('jobs.edit');
    Route::patch('/jobs/{job}', 'update')->name('jobs.update');
    Route::delete('/jobs/{job}', 'destroy')->name('jobs.destroy');
});
```

FURTHER shortening:
```
Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store');
    Route::get('/jobs/{job}/edit', 'edit');
    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});
```

Instead you can use Route::resource
`Route::resource('jobs', JobController::class);`

Filtering:
```
Route::resource('jobs', JobController::class, [
    'except' => ['edit']
]);

// often you dont need to gen ALL 7 routes.
// you can specify only the ones you need like so:
    // or you can do the inverse and exclude the ones you dont need:
    // edit will then dissapear

// you can use only if you wish
```

"Resource handled by dedicated controller class"
Follow the function names to a T... for other controllers.
There are 7 of them
* index
* create
* show
* store
* edit
* update
* destroy