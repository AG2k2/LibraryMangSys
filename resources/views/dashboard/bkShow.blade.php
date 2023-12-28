<x-layout>

    <section class="flex flex-col items-start justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">

        <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
            <div class="w-1/5">
                <img src="{{ asset('storage/' . $book->cover) }}" alt="book cover" class="w-full">
            </div>
            <div class="flex flex-col items-start h-full ">
                <a href="/books/{{ $book->ISBN }}/edit" class="px-3 my-2 text-base text-gray-900 bg-gray-100 border border-gray-200 rounded-md hover:underline">
                    Edit this book
                </a>
                <h3 class="px-3 my-2 text-xl text-gray-900 ">
                    <span class="font-bold">Title:</span> {{ $book->title }}
                </h3>
                <h3 class="px-3 my-2 text-xl text-gray-900 ">
                    <span class="font-bold">Author:</span> {{ $book->Author->name  }}
                </h3>
            </div>

        </header>

        <main class="relative z-30 flex flex-col items-center justify-center w-full">
            <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                <table class="text-lg">
                    <tr>
                        @foreach ($book->categories as $category)
                            <a href="?category={{ $category->slug }}" class="p-1 mx-1 text-base rounded-md bg-bgcolor-950 hover:bg-bgcolor-900">{{ $category->name }}</a>
                        @endforeach
                    </tr>
                    <tr>
                        <td class="p-2">DDC:</td>
                        <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">{{ $book->DDC }}</td>
                    </tr>
                    <tr>
                        <td class="flex items-start p-2">Description:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $book->description }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2">Publish date:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $book->published_at }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap">Added at:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $book->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap"> Copies available / Copies signed:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                            {{ $book->available . ' / ' . $book->copies_no }}
                        </td>
                    </tr>
                </table>
            </div>

            <section class="w-full">
                <div class="flex justify-between w-full p-2">
                    <div>
                        <p class="text-lg">
                            {{ $students->count() }} borrowed this book.
                        </p>
                    </div>
                    <div class="flex gap-3">
                        <a href="#" class="inline-flex items-center px-2 py-1 rounded-lg bg-bgcolor-950">Sign a new borrow</a>
                        <a href="#" class="inline-flex items-center px-2 py-1 rounded-lg bg-bgcolor-950">Sign a return</a>
                    </div>
                </div>
                <ul>
                    @if (!$students->isEmpty())
                        <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                            <p class="col-span-2 col-start-2">Full name</p>
                            <p class="col-span-2">ID</p>
                            <p class="col-span-2">Join</p>
                            <p class="col-span-2">Last book borrowed</p>
                            <p class="col-span-2">Ret. date</p>
                        </li>
                    @endif
                    @foreach ($students as $student)
                        <li class="grid items-center w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                            <p class="text-xs">
                                {{ Carbon\Carbon::parse($student->pivot->taken_at)->format('Y-m-d') }}
                            </p>

                            <p class="col-span-2 truncate">
                                {{ $student->first_name . ' ' . $student->last_name }}
                            </p>

                            <p class="col-span-2 truncate">
                                {{ $student->id }}
                            </p>

                            <p class="col-span-2 text-sm truncate">
                                <time>
                                    {{ $student->created_at->format('Y / m / d') }}
                                </time>
                            </p>

                            <p class="col-span-2 truncate">
                                @if (! $student->books->isEmpty())
                                    <a href="/dashboard/books/{{ $student->books->first()->ISBN }}" class="hover:underline">
                                        {{ $student->books->first()->title }}
                                    </a>
                                @endif
                            </p>

                            <div class="col-span-2 truncate" >
                                @if (! $student->books->isEmpty() )
                                    @if ($student->books->first()->pivot->return_at !== null)
                                        <p class="text-sm text-white ">
                                            <span>
                                                {{ Carbon\Carbon::parse($student->books->first()->pivot->return_at)->format('Y / m / d') }}
                                            </span>
                                        </p>
                                    @else
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
                                    @endif
                                @endif
                            </div>

                            <p>
                                <a href="/dashboard/students/{{ $student->id }}" class="text-sm hover:underline">
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
