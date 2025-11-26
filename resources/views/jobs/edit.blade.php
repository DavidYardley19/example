<x-layout>
    <x-slot:heading>
        Edit Job: {{ $job['title'] }}
    </x-slot:heading>

    <form method="POST" action="/jobs/{{ $job['id'] }}">
        @csrf
        @method('PATCH')
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 py-4">
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                <input
                                    required
                                    id="title"
                                    type="text"
                                    name="title"
                                    placeholder="IT Support Technician"
                                    class="block min-w-0 grow bg-white px-3 py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    value="{{ $job['title'] }}"
                                   />
                            </div>
                            @error('title')
                                <div class="mt-2 text-sm text-red-600 font-semibold mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="sm:col-span-4">
                        <label for="salary" class="block text-sm/6 font-medium text-gray-900">Salary</label>
                        <div class="mt-2">
                            <div class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                                <div class="shrink-0 text-base text-gray-500 select-none sm:text-sm/6"></div>
                                <input
                                    required
                                    id="salary"
                                    type"text"
                                    name="salary"
                                    placeholder="£28,000"
                                    class="block min-w-0 grow bg-white px-3 py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                                    value="{{ $job['salary'] }}"
                                />
                            </div>
                            @error('salary')
                                <div class="mt-2 text-sm text-red-600 font-semibold mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div "flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-semibold">Delete</button>
            </div>
            <div class="flex items-center justify-end gap-x-6">
                <a href="/jobs/{{ $job['id'] }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-600">Update</button>
            </div>
        </div>
    </form>

    <form id="delete-form" method="POST" action="/jobs/{{ $job['id'] }}" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
