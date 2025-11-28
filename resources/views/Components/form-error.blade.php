@props(['name'])

@error($name)
    <div class="mt-2 text-sm text-red-600 font-semibold mt-1">{{ $message }}</div>
@enderror
