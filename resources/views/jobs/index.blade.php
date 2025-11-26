<x-layout>
    <x-slot:heading>
        Jobs Page
    </x-slot:heading>
    
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

    <div>
        {{ $jobs->links() }}
    </div>

</x-layout>
