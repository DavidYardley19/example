<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    {{ $greeting }} My name is {{ $name }}
    
    <!-- Can use ?php foreach ... but recall blade directives can be easier to read, understand, write -->
    <!-- i need a class for the div to seperate each anchor, how? -->
     <!-- use: space-y-4 ... but that doesnt change anything
     then use: divide-y divide-gray-200 
     -->
     <!-- can i use margin instead or something else?
     ans: use: gap-4 but that needs to be flex or grid 
     -->
    <div class="gap-4 flex flex-col">
        @foreach ($jobs as $job)
            <a href='/jobs/{{ $job["id"] }}' class="block px-4 py-6 border border-gray-200 rounded-lg">
                <div class="font-bold text-blue-500 text-sm"> {{ $job->employer->name }} </div>
                <div>
                    <b>{{ $job['title'] }}</b> : Pays <b>{{ $job['salary'] }}</b> per year
                </div>
            </a>
        @endforeach
    </div>
</x-layout>
