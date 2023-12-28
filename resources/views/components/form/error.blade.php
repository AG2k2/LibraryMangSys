@props(['name'])

@error($name)
    <p class="text-base text-red-500">* {{ $message }}</p>
@enderror
