<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    
    <h2 class="font-bold text-lg">
        {{ $job['title'] }} - Pays {{ $job['salary'] }} per year
    </h2>
</x-layout>