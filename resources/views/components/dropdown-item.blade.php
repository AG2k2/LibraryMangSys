
@props(['name', 'value'])

<li>
    <a href="?{{ $name }}={{ $value }}" class="block w-full px-2 hover:bg-bgcolor-900">
        {{ ucfirst($value) }}
    </a>
</li>
