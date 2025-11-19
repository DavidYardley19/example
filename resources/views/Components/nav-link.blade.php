<!-- => false is the default, the otherwise -->
@props(['active' => false, "type" => "a"])
<!-- The above is a blade directive
 It will hide this when inspecting element in the browser
    It also allows passing in an 'active' prop when calling the component
    We will use this to determine which page we are on
This is different from standard attributes passed in-->

<!-- Ep5 Homework
    Extend the nav-link component by adding a new prop called type
    This will determine whether the component renders as an anchor tag or a button
        if type is 'button', render a button tag
        if type is 'a', render an anchor tag
    Implement this conditional rendering inside the nav-link component
        Check the laracasts comments to see peoples qna's.
-->

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

