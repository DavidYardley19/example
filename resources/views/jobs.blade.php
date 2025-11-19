<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    {{ $greeting }} My name is {{ $name }}
    
    <!-- Can use ?php foreach ... but recall blade directives can be easier to read, understand, write -->
    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href='/jobs/{{ $job["id"] }}' class="text-blue-500 hover:underline">
                    <!-- need to create routes for these -->
                    <b>{{ $job['title'] }}</b> : Pays <b>{{ $job['salary'] }}</b> per year
                </a>
            </li>
        @endforeach
    </ul>
</x-layout>