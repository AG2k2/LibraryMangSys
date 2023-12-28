<x-layout>

    <section class="flex flex-col items-start justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">
        <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
            <div class="flex flex-col w-2/5 gap-3">
                <img src="{{ asset( 'storage/' . $author->auth_pic) }}" alt="author picture" class="w-full">
            </div>
            <div class="w-full gap-2 px-3 my-2 text-xl text-gray-900">
                <p class="w-full">{{ $author->name }}</p>
            </div>
        </header>

            <main class="relative z-30 flex flex-col items-center justify-center w-full gap-5">
                <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                    <table class="text-lg">
                        <tr>
                            <td class="p-2"><p>Born in:</p></td>
                            <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                <p>{{ $author->birth_year }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2"><p>Died in:</p></td>
                            <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                <p>{{ $author->death_year }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-start p-2"><p>Excerpt:</p></td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                <p>{{ $author->excerpt }}</p>
                            </td>
                        </tr>
                    </table>

                </div>
                <section class="grid w-10/12 grid-cols-12 gap-5 md:w-9/12 lg:w-8/12">
                    <h3 class="col-span-12 text-xl">Author's books ({{ $author->books->count() }}):</h3>
                    @foreach ($author->books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                    @if ($author->books->count() == 0)
                        <p class="col-span-12">This author has no books registered yet.</p>
                    @endif
                </section>
            </main>
        </form>

    </section>

</x-layout>
