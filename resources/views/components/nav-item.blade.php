@props(['route', 'value', 'req'])

<li>
    <a href={{ route($route) }} class="block px-3 py-2 text-lg duration-200 rounded-t-xl h-fit  {{ Request::is("$req", "$req/*" ) || ($req == 'management' && Request::is("*/create")) ? 'bg-bgcolor-800': 'hover:bg-bgcolor-850' }}">
        {{ $value }}
    </a>
</li>
