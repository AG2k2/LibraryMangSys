<x-layout>

    <section>

        <main class="grid grid-cols-12 col-span-10 col-start-4 gap-2 p-2 h-fit">


            <div class="flex items-center justify-between col-span-12">
                <p class="p-2 text-lg">{{ $authors->total() }} authors</p>
                @auth
                    @if (auth()->user()->role === 'manager' )
                        <a href="{{ route('authorsCreate') }}" class="px-2 py-1 m-2 text-xl text-black duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-300">
                            Add an author
                        </a>
                    @endif
                @endauth
            </div>

            <form action="?" method="GET" class="flex col-span-8 col-start-3 my-2">
                <input type="text" name="search" id="search" placeholder="Looking for an author?" class="w-full px-3 py-1 text-lg border border-r-0 border-gray-300 rounded-l-full">
                <button type="submit" class="w-1/12 px-3 py-1 bg-white border border-l-0 border-gray-300 rounded-r-full hover:text-gray-700 hover:cursor-pointer"><i class="fa fa-search"></i></button>
            </form>

            @foreach ($authors as $author)
                <div class="relative col-span-12 lg:col-span-6">

                    <div class="relative z-30 flex flex-col h-full gap-3 p-3 bg-gray-100 border border-gray-300 rounded-md">

                        <section class="flex items-center justify-between w-full">
                            <div class="flex items-center gap-3 w-fit">
                                <img src="{{ asset('storage/'.$author->auth_pic) }}" alt="author picture" class="block w-2/12 h-fit">

                                <h3 class="my-2 text-lg font-bold text-black truncate">
                                    <a href={{ route('authorsShow', $author->id) }}>{{ $author->name }}</a>
                                </h3>
                            </div>

                            <p class="w-fit whitespace-nowrap">
                                {{ $author->birth_year }} - {{ $author->death_year }}
                            </p>
                        </section>


                        <p class="h-24 overflow-hidden">{{ $author->excerpt }}</p>

                        <ul class="flex flex-col gap-2">
                            @foreach ($author->books->slice(0, 3) as $book)
                                <li class="w-full">
                                    <a href="{{ route('booksShow', $book->ISBN) }}" class="block w-full p-1 px-3 bg-gray-200 rounded-md hover:bg-gray-300">{{ $book->title }}</a>
                                </li>
                            @endforeach
                        </ul>

                        @if ($author->books->count() > 3)
                            <p>
                                <a href="{{ route('authorsShow', $author->id) }}" class="hover:underline">Show all books...</a>
                            </p>
                        @endif

                    </div>

                    <div class="absolute top-0 z-20 w-full h-full rounded-md bg-bgcolor-950 -rotate-2"></div>
                </div>
            @endforeach
        </main>

        <footer class="my-2 md:col-span-10 md:col-start-4">
            {{ $authors->onEachSide(1)->links('dashboard.pagination') }}
        </footer>

    </section>

</x-layout>
