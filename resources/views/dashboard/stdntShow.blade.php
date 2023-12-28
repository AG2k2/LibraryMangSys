<x-layout>

    <section class="flex flex-col items-start justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">

        <header class="z-50 flex items-end justify-center gap-3 mb-5 reltive top-28">
            <div>
                <img src="{{ asset('storage/' . $student->pro_pic) }}" alt="#" class="relative border-4 rounded-full border-bgcolor-850 w-52 h-52 bg-bgcolor-850">
            </div>
            <div class="flex flex-col items-start h-full ">
                <h3 class="px-3 my-2 text-xl text-gray-900 ">
                    <span class="font-bold">ID:</span> {{ $student->id  }}
                </h3>
                <h3 class="px-3 my-2 text-xl text-gray-900 ">
                    <span class="font-bold">Full name:</span> {{ ucwords($student->first_name . ' ' . $student->last_name) }}
                </h3>
                <h3 class="px-3 my-2 text-xl text-gray-900 ">
                    <span class="font-bold">Username:</span> {{ '@'. $student->username  }}
                </h3>
            </div>
        </header>

        <main class="relative z-30 flex flex-col items-center justify-center w-full">
            <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                <table class="text-lg">
                    <tr>
                        <td class="p-2">Gender:</td>
                        <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">{{ $student->gender == 'm' ? 'Male' : 'Female' }}</td>
                    </tr>
                    <tr>
                        <td class="p-2">Email:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $student->email }}
                            <span class="p-1 text-sm text-black rounded-md
                            {{ $student->email_verified_at == null ? 'bg-red-400' : 'bg-green-400'  }}">
                            {{ $student->email_verified_at == null ? 'unverified' : 'verified' }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">Submition:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                        @if ($student->enroll_submitted_at != null)
                                <span class="p-1 text-lg text-black rounded-xl">
                                    Submitted at {{ $student->enroll_submitted_at }}
                                </span>
                            @else
                                <span class="p-1 text-lg text-black rounded-xl">
                                    Not submitted
                                </span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap">Birth date:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ Carbon\Carbon::parse($student->birth_date)->format('Y / m / d') }} - ({{ Carbon\Carbon::parse($student->birth_date)->age }} years old)
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap">Joined:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                            {{ $student->created_at->format('Y / m / d') }} - ({{ $student->created_at->diffForHumans() }})
                        </td>
                    </tr>
                </table>
            </div>

            <section class="w-full">
                <div class="flex justify-between p-2 ">
                    <div>
                        <p class="text-lg">
                            Borrowed {{ $books->count() }} books.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="inline-flex items-center p-1 rounded-lg bg-bgcolor-950">Sign a new borrow</a>
                        <a href="#" class="inline-flex items-center p-1 rounded-lg bg-bgcolor-950">Sign a return</a>
                    </div>
                </div>
                <ul>
                    <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                        <p class="col-span-3 col-start-2">Title</p>
                        <p class="col-span-2">ISBN</p>
                        <p class="col-span-2">DDC</p>
                        <p class="col-span-2">Ret. date</p>
                        <p class="col-span-1">Availabe</p>
                    </li>
                    @foreach ($books as $book)

                        <li class="grid w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                            <p class="flex items-center text-xs">
                                @if ($book->pivot->taken_at != null)
                                    {{ Carbon\Carbon::parse($book->pivot->taken_at)->format('Y-m-d') }}:
                                @endif
                            </p>

                            <p class="col-span-3 truncate">
                                <a href="/books/{{ $book->ISBN }}" class="my-auto hover:underline">
                                    {{ $book->title }}
                                </a>
                            </p>

                            <p class="col-span-2 truncate">
                                {{ $book->ISBN }}
                            </p>

                            <p class="col-span-2 truncate">
                                {{ $book->DDC }}
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
                                {{ $book->available }} / {{ $book->copies_no }}
                            </p>

                            <p class="col-span-1">
                                <a href="/dashboard/books/{{ $book->ISBN }}" class="text-sm hover:underline">
                                    More...
                                </a>
                            </p>

                        </li>
                    @endforeach
                </ul>
            </section>
        </main>

    </section>

</x-layout>
