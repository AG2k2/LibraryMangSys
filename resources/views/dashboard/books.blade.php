<x-layout>

    <x-dashboard.layout page="Books" >

        <form action="/dashboard/books" method="GET" class="flex flex-col items-center gap-3 p-2 md:flex-row justify-evenly bg-bgcolor-850 ">
            <x-dashboard.label name="bkSearch" value="Search for a book by name, ISBN, DDC:" />
            <div class="w-full md:w-1/2">
                <x-dashboard.input
                name="bkSearch"
                value="{{ request('bkSearch') ? request('bkSearch') : '' }}" />
            </div>
            <button type="submit" class="px-2 py-1 text-white bg-gray-900 rounded-lg">Search</button>
        </form>

        <div class="p-2 my-3 text-xl rounded-md bg-bgcolor-850">

            {{--=== HEADER ===--}}
            <div class="flex items-center justify-between px-2">

                <h3 class="p-2">{{ count($books) }} books:</h3>

                {{--=== SORTING LIST ===--}}
                <x-dashboard.sortby search="stdntSearch">

                    <x-dashboard.sortby-item query="sortBy" value="title" />

                    <x-dashboard.sortby-item query="sortBy" value="ISBN" />

                    <x-dashboard.sortby-item query="sortBy" value="DDC" />

                </x-dashboard.sortby>
            </div>

            <ul>
                <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                    <p class="col-span-3">Title</p>
                    <p class="col-span-2">ISBN</p>
                    <p class="col-span-2">Author</p>
                    <p class="col-span-2">DDC</p>
                    <p class="col-span-2">Availabe</p>
                </li>
                @foreach ($books as $book)

                    <li class="grid w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                        <p class="col-span-3 truncate text-start">
                            <a href="/books/{{ $book->ISBN }}" class="hover:underline">
                                {{ $book->title }}
                            </a>
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $book->ISBN }}
                        </p>

                        <p class="col-span-2 text-base truncate">
                            <time>
                                {{ $book->author->name }}
                            </time>
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $book->DDC }}
                        </p>

                        <p class="col-span-2">
                            {{ $book->available }} / {{ $book->copies_no }}
                        </p>

                        <p class="col-span-1">
                            <a href="/dashboard/books/{{ $book->ISBN }}" class="text-sm hover:underline">
                                More...
                            </a>
                        </p>

                    </li>
                @endforeach
                {{ $books->links() }}
            </ul>
        </div>

    </x-dashboard.layout>



</x-layout>
