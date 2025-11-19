<!-- Going to use the layout component for this page, it's treated like a custom html tag -->
<x-layout>
    <x-slot:heading>
        Home Page
    </x-slot:heading>
    {{ $greeting }} My name is {{ $name }}
</x-layout>