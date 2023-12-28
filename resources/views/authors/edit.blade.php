<x-layout>

    <section class="flex flex-col items-start justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">
        <form action="{{ route('authorsDestroy', $author->id) }}" method="POST" enctype="multipart/form-data" class="w-full text-end">
            @csrf
            @method('DELETE')
            <button class="text-lg text-red-600 hover:underline">Delete This author</button>
        </form>
        <form action="/authors/{{ $author->id }}" method="POST" enctype="multipart/form-data" class="w-full">
            @csrf
            @method('PATCH')
            <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
                <div class="flex flex-col w-2/5 gap-3">
                    <img src="{{ asset( 'storage/' . $author->auth_pic) }}" alt="author picture" class="w-full">
                </div>
                <div class="relative flex flex-col items-start w-full h-full">
                    <input type="file" name="auth_pic" id="auth_pic">
                    <div class="flex w-full gap-2 px-3 my-2 text-xl text-gray-900">
                        <label class="w-1/6 font-bold " for="name">Name:</label>
                        <input type="text" name="name" id="name" value=" {{ $author->name }}" class="inline-block w-full px-1 rounded-md bg-bgcolorbg-red-800">
                    </div>
                </div>
            </header>

            <main class="relative z-30 flex flex-col items-center justify-center w-full">
                <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                    <table class="text-lg">
                        <tr>
                            <td class="p-2"><label for="birth_year">Born in:</label></td>
                            <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                <input type="text" name="birth_year" id="birth_year" value="{{ $author->birth_year  }}" class="inline-block w-full px-2 rounded-md bg-bgcolorbg-red-800">
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2"><label for="death_year">Died in:</label></td>
                            <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                <input type="text" name="death_year" id="death_year" value="{{ $author->death_year  }}" class="inline-block w-full px-2 rounded-md bg-bgcolorbg-red-800">
                            </td>
                        </tr>
                        <tr>
                            <td class="flex items-start p-2"><label for="excerpt">Excerpt:</label></td>
                            <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                <textarea name="excerpt" id="excerpt" class="w-full px-2 rounded-lg" rows="4">{{ $author->excerpt }}</textarea>
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
