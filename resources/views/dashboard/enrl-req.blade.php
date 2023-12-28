<x-layout>
    <x-dashboard.layout page="Submittion">

        {{--=== SEARCH FIELD ===--}}
        <form action="/dashboard/submittion" method="GET" class="flex flex-col items-center gap-3 p-2 md:flex-row justify-evenly bg-bgcolor-850 ">
            <x-dashboard.label name="stdntSearch" value="Search for a student by name or ID:" />
            <div class="w-full md:w-1/2">
                <x-dashboard.input
                name="stdntSearch"
                value="{{ request('stdntSearch') ? request('stdntSearch') : '' }}"/>
            </div>
            <button type="submit" class="px-3 py-2 text-white bg-gray-900 rounded-lg">Search</button>
        </form>


        <div class="p-2 my-3 text-xl rounded-md bg-bgcolor-850">

            {{--=== HEADER ===--}}
            <div class="flex items-center justify-between px-2">

                <h3 class="p-2">Students not submitted:</h3>

                {{--=== SORTING LIST ===--}}
                <div class="flex items-end justify-center gap-2">
                    <div x-data="{ show:false }" @click.away="show = false" class="relative flex flex-col items-center justify-center w-32 gap-1">
                        <p class="text-sm font-bold text-black">
                            Sort by:
                        </p>
                        <x-dropdown-trigger class="relative w-full px-2 py-1 text-base bg-white rounded-md">
                            {{ request('sortBy') ? ucfirst(request('sortBy')) : 'Id' }}
                        </x-dropdown-trigger>
                        <div class="relative w-full">
                            <x-dropdown-items class="absolute flex flex-col w-full gap-2 py-2 text-base bg-gray-100 border border-gray-300 rounded-xl">
                                <x-dropdown-item
                                name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&sortBy" value="id" />

                                <x-dropdown-item name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&sortBy" value="name" />

                                <x-dropdown-item name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&sortBy" value="username" />

                                <x-dropdown-item name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&sortBy" value="joined-in" />

                                <x-dropdown-item name="{{ http_build_query(request()->except('sortBy', 'ord')) }}&sortBy" value="email-verification" />

                            </x-dropdown-items>
                        </div>
                    </div>

                    <form action="/dashboard/submittion" method="GET" class="mx-auto text-sm font-bold text-center text-black duration-200 rounded-xl w-fit h-fit">

                        @if (request('sortBy'))
                            <input type="hidden" name="sortBy" value="{{ request('sortBy') }}">
                        @endif

                        @if (request('stdntSearch'))
                            <input type="hidden" name="stdntSearch" value="{{ request('stdntSearch') }}">
                        @endif

                        <input type="hidden" name="ord" value="{{ request('ord') == null || request('ord') == 'desc' ? 'asc' : 'desc'  }}">

                        <button type="submit" class="p-2 hover:underline">
                            {{ request('ord') == 'desc' || request('ord') == null ? 'Descending' : 'Ascending' }}
                        </button>

                    </form>
                </div>
            </div>

            {{--=== REQUESTS LIST ===--}}
            <ul>
                <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                    <p class="col-span-2 col-start-2">Name</p>
                    <p class="col-span-2">username</p>
                    <p class="col-span-2">Card ID</p>
                    <p class="col-span-2">Email veryfied</p>
                    <p class="col-span-1"></p>
                </li>
                @if ($students->isEmpty())
                    <li>
                        <p class="p-3">
                            No submitted students with such name
                        </p>
                    </li>
                @endif
                @foreach ($students as $student)
                    <li class="grid items-center w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                        <p class="col-span-1 text-[0.8rem] truncate text-start">
                            <time>
                                {{ $student->created_at->format('Y / m / d') }}:
                            </time>
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $student->first_name . ' ' . $student->last_name }}
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $student->username }}
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $student->id }}
                        </p>

                        <div class="flex items-center col-span-2 truncate">
                            <p class="text-sm font-bold truncate">
                                {{ $student->email }}
                            </p>
                            <p class="p-1 text-xs text-black rounded-md
                            {{ $student->email_verified_at == null ? 'bg-red-400' : 'bg-green-400'  }}">
                                {{ $student->email_verified_at == null ? 'unverified' : 'verified' }}
                            </p>
                        </div>

                        <form action="/users/submittion/{{ $student->id }}" class="col-span-1" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="enroll_submitted_at" value="{{ now() }}">
                            <button type="submit" class="w-full text-base text-green-500 hover:underline">Submit</button>
                        </form>

                        <form action="/users/submittion/{{ $student->id }}" class="col-span-1" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="enroll_submitted_at" value="{{ now() }}">
                            <button type="submit" class="w-full text-base text-red-500 hover:underline">Decline</button>
                        </form>

                        <p>
                            <a href="/dashboard/students/{{ $student->id }}" class="text-sm hover:underline">
                                More...
                            </a>
                        </p>

                    </li>
                @endforeach
                {{ $students->links() }}
            </ul>
        </div>
    </x-dashboard.layout>

</x-layout>
