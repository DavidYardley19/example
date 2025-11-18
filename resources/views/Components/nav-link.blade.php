<a {{ $attributes }}>{{ $slot }}</a>
<!-- attributes is an object, you may wish to use {{ $attributes->merge(['class' => 'nav-link']) }} -->
 <!-- style is carried over if just calling all of attributes (set red to about link) -->