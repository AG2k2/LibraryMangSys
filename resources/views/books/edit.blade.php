<x-layout>

    <section class="flex flex-col items-start justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">
        <form action="{{ route('booksDestroy', $book->id) }}" method="POST" enctype="multipart/form-data" class="w-full text-end">
            @csrf
            @method('DELETE')
            <button class="text-lg text-red-600 hover:underline">Delete This book</button>
        </form>
        <form action="/books/{{ $book->id }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PATCH')
            <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
                <div class="flex flex-col w-2/5 gap-3">
                    <img src="{{ asset( 'storage/' . $book->cover) }}" alt="book cover" class="w-full">
                </div>
                <div class="relative flex flex-col items-start w-full h-full">
                    <input type="file" name="cover" id="cover">
                    <h3 class="flex w-full gap-2 px-3 my-2 text-xl text-gray-900">
                        <label class="w-1/6 font-bold " for="title">Title:</label>
                        <input type="text" name="title" id="title" value=" {{ $book->title }}" class="inline-block w-full px-1 rounded-md bg-bgcolorbg-red-800">
                    </h3>
                    <h3 class="flex w-full gap-3 px-3 my-2 text-xl text-gray-900">
                        <label for="title" class="w-1/6 font-bold">Author:</label>
                        <input type="text" name="author" id="author" value="{{ $book->Author->name  }}" class="inline-block w-full px-2 rounded-md bg-bgcolorbg-red-800">
                    </h3>
                </div>
            </header>

            <main class="relative z-30 flex flex-col items-center justify-center w-full">
                <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                    <table class="text-lg">
                        <tr>
                            <td class="p-2"><label for="DDC">DDC:</label></td>
                            <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                <input type="text" name="DDC" id="DDC" value="{{ $book->DDC  }}" class="inline-block w-full px-2 rounded-md bg-bgcolorbg-red-800">
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-start p-2"><label for="description">Description:</label></td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                <textarea name="description" id="description" class="w-full px-2 rounded-lg" rows="4">{{ $book->description }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2"><label for="published_at">Publish date:</label></td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                <input type="text" name="published_at" id="published_at" value="{{ $book->published_at  }}" class="inline-block w-full px-2 rounded-md bg-bgcolorbg-red-800">
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 md:whitespace-nowrap">Added at:</td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                {{ $book->created_at }}
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2 md:whitespace-nowrap">
                                <label for="copies_no">Copies available / Copies signed:</label>
                            </td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                                {{ $book->available . ' / ' }}
                                <input type="number" name="copies_no" id="copies_no" value="{{ $book->copies_no  }}" class="inline-block w-16 px-2 rounded-md bg-bgcolorbg-red-800">
                            </td>
                        </tr>
                    </table>
                    <div class="flex justify-end p-2">
                        <button class="p-2 rounded-md bg-bgcolor-850">
                            Save changes
                        </button>
                    </div>
                </div>
            </main>
        </form>

    </section>

</x-layout>
