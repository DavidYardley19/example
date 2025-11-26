<x-layout>
    <x-slot:heading>
        Job
    </x-slot:heading>
    
    <h2 class="font-bold text-lg">
        {{ $job['title'] }} - Pays {{ $job->salary }} per year
    </h2>

    <p class="mt-4">
        <!-- below is using an id -->
        <!-- <x-button href="/jobs/{{ $job['id'] }}/edit">Edit Job</x-button> -->
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>

    </p>

</x-layout>
