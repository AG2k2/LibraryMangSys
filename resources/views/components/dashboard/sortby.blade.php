@props(['search'])

<div class="flex items-end justify-center gap-2">
    <div x-data="{ show:false }" @click.away="show = false" class="relative flex flex-col items-center justify-center w-32 gap-1">
        <p class="text-sm font-bold text-black">
            Sort by:
        </p>
        <x-dropdown-trigger class="relative w-full px-2 py-1 text-base bg-white rounded-md">
            {{ request('sortBy') ? ucfirst(request('sortBy')) : 'Sort by:' }}
        </x-dropdown-trigger>
        <div class="relative w-full">
            <x-dropdown-items class="absolute flex flex-col w-full gap-2 py-2 text-base bg-gray-100 border border-gray-300 rounded-xl">

                {{ $slot }}

            </x-dropdown-items>
        </div>
    </div>

    <form action="{{ URL::current() }}" method="GET" class="mx-auto text-sm font-bold text-center text-black duration-200 rounded-xl w-fit h-fit">

        @if (request('sortBy'))
            <input type="hidden" name="sortBy" value="{{ request('sortBy') }}">
        @endif

        @if (request($search))
            <input type="hidden" name="{{ $search }}" value="{{ request($search) }}">
        @endif

        <input type="hidden" name="ord" value="{{ request('ord') == null || request('ord') == 'desc' ? 'asc' : 'desc'  }}">

        <button type="submit" class="p-2 hover:underline">
            {{ request('ord') == 'desc' || request('ord') == null ? 'Descending' : 'Ascending' }}
        </button>

    </form>
</div>
