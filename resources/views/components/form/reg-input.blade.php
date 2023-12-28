@props(['name', 'value', 'type' => 'text'])

<div {{ $attributes }}>
    <label for={{ $name }} class="block mb-1 text-lg">{{ $value }}:</label>
<input required type={{ $type }} {{ $attributes }} class="block w-full p-2 bg-gray-200 border border-gray-300 rounded-lg focus:outline-black " id={{ $name }} name={{ $name }} value={{ $type != 'password' ? old($name): '' }}>
</div>
