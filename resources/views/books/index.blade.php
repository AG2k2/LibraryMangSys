<x-layout>

    <section class="relative flex flex-col w-full h-full gap-4 p-3 m-auto md:grid-cols-12 md:grid">

        <x-side-nav-bar />

        <main class="grid grid-cols-12 col-span-10 col-start-4 gap-2 h-fit">

            <div class="flex items-center justify-between col-span-12">
                <p class="p-2 text-lg">{{ $books->total() }} books</p>
                @auth
                    @if (in_array(auth()->user()->role, ['supervisor', 'libirarian']) )
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
