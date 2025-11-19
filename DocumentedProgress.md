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
        >> When prefixing prop names.

Can also create a @php directive (with @endphp)
    Within here, some conditionals can be set.
    Tweak specific values
    All is isolated in this component

## Ep 6 - View Data and Route Wildcards

Recap on homework from Ep 5

