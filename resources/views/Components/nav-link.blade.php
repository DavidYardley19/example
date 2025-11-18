<!-- => false is the default, the otherwise -->
@props(['active' => false])
<!-- The above is a blade directive
 It will hide this when inspecting element in the browser
    It also allows passing in an 'active' prop when calling the component
    We will use this to determine which page we are on
This is different from standard attributes passed in-->

<!-- if active = true, run this stuff -->
<a
    class= "{{ $active ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}"
    aria-current = "{{ $active ? 'page' : 'false' }}"
    {{$attributes}}
    >{{$slot}}</a>
