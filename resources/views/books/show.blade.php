<x-layout>

    @auth
        @if (auth()->user()->email_verified_at == null)
            <p class="p-3 m-3 mb-0 text-center bg-red-500 bg-opacity-25 rounded-lg">
                You need to verify your email to be able to borrow books. <a href="" class="text-red-900 underline">Send email varification</a>
            </p>
        @endif
        @if (auth()->user()->enroll_submitted_at == null)
            <p class="p-3 m-3 mb-0 text-center bg-red-500 bg-opacity-25 rounded-lg">
                You need to wait until your enrollment is submitted by one of the librarians. <a href="" class="text-red-900 underline">Send email varification</a>
            </p>
        @endif
    @endauth

    <section class="flex flex-col gap-5 p-5 md:flex-row">

        <img src="{{ asset('storage/' . $book->cover) }}" alt="book cover" class="w-full h-full rounded-md md:w-60">

        <main class="flex flex-col gap-4">
            <div class="p-1 border md:p-3 lg:p-5 bg-bgcolor-900 border-bgcolor-950 rounded-xl">
                <table class="table-auto">
                    <tr>
                        <a href="{{ route('booksEdit', $book->ISBN) }}">
                            Edit this book
                        </a>
                    </tr>
                    <tr>
                        <h3 class="my-2 text-2xl font-bold">Book information:</h3>
                    </tr>
                    <tr>
                        @foreach ($book->categories as $category)
                            <a href="?category={{ $category->slug }}" class="p-1 mx-1 text-base rounded-md bg-bgcolor-800 hover:bg-bgcolor-800">{{ $category->name }}</a>
                        @endforeach
                    </tr>
                    <tr class="text-lg">
                        <td class="p-1 md:p-2">Title:</td>
                        <td class="p-1 md:p-2">{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2 md:whitespace-nowrap">Published at:</td>
                        <td class="p-1 md:p-2"><time>{{ $book->published_at }}</time></td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2">Author:</td>
                        <td class="p-1 md:p-2">{{ $book->author->name }}</td>
                    </tr>
                    <tr>
                        <td class="flex items-start p-1 md:p-2">Description:</td>
                        <td class="p-1 md:p-2">{{ $book->description }}</td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2 md:whitespace-nowrap">DDC:</td>
                        <td class="p-1 md:p-2">{{ $book->DDC }}</td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2 md:whitespace-nowrap">Copies available:</td>
                        <td class="p-1 md:p-2">{{ $book->available }}</td>
                    </tr>
                </table>
            </div>

            <div class="relative p-1 border md:p-3 lg:p-5 bg-bgcolor-700 border-bgcolor-900 rounded-xl">
                <img src="{{ asset('storage/' . $book->author->auth_pic) }}" alt="author photo" class="p-2 mx-auto w-36 rounded-xl md:w-36 md:absolute right-8 top-8">
                <table class="table-auto">
                    <tr>
                        <h3 class="my-2 text-2xl font-bold">Author information:</h3>
                    </tr>
                    <tr class="text-lg">
                        <td class="p-1 md:p-2">Name:</td>
                        <td class="p-1 md:p-2">{{ $book->author->name }}</td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2 md:whitespace-now ap">Born in:</td>
                        <td class="p-1 md:p-2"><time>{{ $book->author->birth_year }}</time></td>
                    </tr>
                    <tr>
                        <td class="p-1 md:p-2">Died in:</td>
                        <td class="p-1 md:p-2">{{ $book->author->death_year }}</td>
                    </tr>
                    <tr>
                        <td class="flex items-start p-1 md:p-2">Excerpt:</td>
                        <td class="p-1 md:p-2">{{ $book->author->excerpt }}</td>
                    </tr>
                </table>
            </div>

            @auth
                @if(auth()->user()->email_verified_at == null || auth()->user()->enroll_submitted_at == null)
                    <p class="p-3 bg-gray-200 border border-gray-300 rounded-xl">
                        Your email is not verfied or your enrollment is not submitted yet.
                    </p>
                @elseif ($isBorrowed )
                    <?php $userBorrow = $book->users->find(auth()->user())->pivot ?>
                    @if ($userBorrow->taken_at == null )
                        <p class="p-3 bg-gray-200 border border-gray-300 rounded-xl">
                            Request is sent in {{ $userBorrow->created_at->format('Y/m/d') }} go to the library to get your book.
                        </p>
                    @elseif($userBorrow->return_at == null)
                        <p class="p-3 bg-gray-200 border border-gray-300 rounded-xl">
                            Need to return this book before {{ date('Y-m-d', strtotime($userBorrow->taken_at) + 60*60*24*7*2) }}
                        </p>
                    @else
                        <form action="/requests/borrow" method="POST">
                            @csrf
                            <input type="hidden" name="ISBN" value="{{ $book->ISBN }}">
                            <button class="p-3 bg-bgcolor-850 rounded-xl">
                                Request this book again
                            </button>
                        </form>
                    @endif
                @elseif ($book->available == 0)
                    <p class="p-3 text-red-500 bg-gray-200 border border-gray-300 rounded-xl">
                        This book isn't available to borrow, come back later.
                    </p>
                @else
                    <form action="/requests/borrow" method="POST">
                        @csrf
                        <input type="hidden" name="ISBN" value="{{ $book->ISBN }}">
                        <button class="p-3 shadow-md bg-bgcolor-850 rounded-xl">
                            Request to borrow this book
                        </button>
                    </form>
                @endif
            @endauth



        </main>

    </section>

</x-layout>
