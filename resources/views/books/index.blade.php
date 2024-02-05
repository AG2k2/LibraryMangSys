<x-layout>

    @auth
        @if (auth()->user()->email_verified_at == null)
        <form action={{route('verification.send')}} method="POST" class="flex justify-center gap-1 p-3 m-3 mb-0 text-center bg-red-500 bg-opacity-25 rounded-lg">
            <p class="">
                You need to verify your email to be able to borrow books.
            </p>
            <button class="text-red-900 underline">Send verification link again</button>
        </form>
        @endif
        @if (auth()->user()->enroll_submitted_at == null)
            <p class="p-3 m-3 mb-0 text-center bg-red-500 bg-opacity-25 rounded-lg">
                You need to wait until your enrollment is submitted by one of the librarians to be able to borrow a book.
                <br>
                If it took too long please check the library.
            </p>
        @endif
    @endauth

    <section class="relative flex flex-col w-full h-full gap-4 p-3 m-auto md:grid-cols-12 md:grid">

        <x-side-nav-bar />

        <main class="grid grid-cols-12 col-span-10 col-start-4 gap-4 h-fit">

            <div class="flex items-center justify-between col-span-12">
                <p class="p-2 text-lg">{{ $books->total() }} books</p>
                <form action="?" method="GET">
                    @if (request('availability') == 'available')
                        <input type="hidden" name="availability" id="availability" value="">
                        <button class="px-2 py-1 text-lg bg-green-300 rounded-md">Show all</button>
                    @else
                        <input type="hidden" name="availability" id="availability" value="available">
                        <button class="px-2 py-1 text-lg bg-green-300 rounded-md">Show available</button>
                    @endif
                </form>
                @auth
                    @if (in_array(auth()->user()->role, ['manager', 'worker']) )
                        <a href="{{ route('booksCreate') }}" class="px-2 py-1 m-2 text-xl text-black duration-200 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-300">
                            Add a book
                        </a>
                    @endif
                @endauth
            </div>

            @foreach ($books as $book)
                <x-book-card :book="$book"/>
            @endforeach
        </main>

        <footer class="md:col-span-10 md:col-start-4">
            {{ $books->onEachSide(1)->links('dashboard.pagination') }}
        </footer>

    </section>

</x-layout>
