
@props(['name', 'type' => 'text', 'value' => null])

<input name="{{ $name }}" value="{{ $value == null ? old($name): $value }}" id="{{ $name }}" type="{{ $type }}" {{ $attributes([ "class" => "w-full px-2 py-1 text-base border-2 rounded-md border-gray-300 bg-gray-100 focus:outline-none focus:border-gray-500"]) }}>

