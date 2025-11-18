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
