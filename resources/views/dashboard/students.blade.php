<x-layout>
    <x-dashboard.layout page="Students">

        <form action="/dashboard/students" method="GET" class="flex flex-col items-center gap-3 p-2 md:flex-row justify-evenly bg-bgcolor-850 ">
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

                <h3 class="p-2">Submitted readers:</h3>

                {{--=== SORTING LIST ===--}}
                <x-dashboard.sortby search="stdntSearch">

                    <x-dashboard.sortby-item query="sortBy" value="id" />

                    <x-dashboard.sortby-item query="sortBy" value="name" />

                    <x-dashboard.sortby-item query="sortBy" value="joined-in" />

                </x-dashboard.sortby>
            </div>

            <ul>
                <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                    <p class="col-span-2 col-start-2">Name</p>
                    <p class="col-span-2">Card ID</p>
                    <p class="col-span-2">role</p>
                    <p class="col-span-2">Last borrowed book</p>
                    <p class="col-span-2">Ret. date</p>
                </li>
                @if ($students->isEmpty())
                    <li>
                        <p class="p-3">
                            No submitted students.
                        </p>
                    </li>
                @endif
                @foreach ($students as $student)
                    <li class="grid items-center w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                        <p class="col-span-1 text-[0.8rem] truncate">
                            <time>
                                {{ $student->created_at->format('Y / m / d') }}:
                            </time>
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $student->first_name . ' ' . $student->last_name }}
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $student->card_id }}
                        </p>

                        @if ($student->enroll_submitted_at != null)
                            <p class="col-span-2 text-base">{{ $student->role }}</p>
                        @endif


                        <p class="col-span-2 truncate">
                            @if (! $student->books->isEmpty())
                                <a href="/dashboard/books/{{ $student->books->first()->ISBN }}" class="hover:underline">
                                    {{ $student->books->first()->title }}
                                </a>
                            @else
                                No books.
                            @endif
                        </p>

                        <div class="col-span-2 truncate" >
                            @if (! $student->books->isEmpty() )
                                @if ($student->books->first()->pivot->return_at !== null)
                                    <p class="text-sm text-black ">
                                        <span>
                                            {{ Carbon\Carbon::parse($student->books->first()->pivot->return_at)->format('Y / m / d') }}
                                        </span>
                                    </p>
                                @elseif($student->books->first()->pivot->taken_at !== null)
                                    <p class="text-sm text-white rounded-md">
                                        <?php
                                            $borrowDate = Carbon\Carbon::parse($student->books->first()->pivot->taken_at);
                                            $timeLeft = now()->diffInDays($borrowDate->addWeeks(2), false)
                                        ?>
                                        @if ($timeLeft >= 5 && $timeLeft <= 14)
                                            <span class="p-1 bg-green-500 rounded-lg">
                                                {{ $borrowDate->addWeeks(2)->format('Y / m / d') }}
                                            </span>
                                        @elseif ($timeLeft >= 0 && $timeLeft < 5)
                                            <span class="p-1 bg-yellow-500 rounded-lg">
                                                {{ $borrowDate->addWeeks(2)->format('Y / m / d') }}
                                            </span>
                                        @else
                                            <span class="p-1 bg-red-500 rounded-lg">
                                                Out-of-date
                                            </span>
                                        @endif
                                    </p>
                                @else
                                    <p>Not taken yet</p>
                                @endif
                            @endif
                        </div>

                        <p class="col-span-1">
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
