@props(['active' => false, "type" => "a"])

@if ($type === 'a')
    <a
        class= "{{ $active ? 'bg-gray-900 text-white border-b-2' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
        aria-current = "{{ $active ? 'page' : 'false' }}"
        {{$attributes}}
        >{{$slot}}</a>
@elseif ($type === 'button')
    <button
        class= "{{ $active ? 'bg-gray-900 text-white border-b-2' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
        aria-current = "{{ $active ? 'page' : 'false' }}"
        {{$attributes}}
        >{{$slot}}</button>
@endif

