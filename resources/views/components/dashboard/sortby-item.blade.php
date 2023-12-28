
@props(['value', 'query'])

<x-dropdown-item
    name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&{{ $query }}"
    value="{{ $value }}" />
