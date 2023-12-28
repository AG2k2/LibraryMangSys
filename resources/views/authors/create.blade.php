<x-layout>

    <section class="flex items-start w-full p-2 pt-8 mb-auto justify-evenly md:p-4 lg:p-6">

        <x-mngmnt-navbar />

        <section class="w-8/12 p-4 shadow-lg">

            <form action="{{ route('authorsStore') }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf

                <h1 class="px-5 py-2 mb-5 text-xl text-center rounded-md bg-bgcolor-950">Add a new author</h1>

                <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
                    <div class="relative flex flex-col items-start w-full h-full gap-2">
                        <input type="file" name="auth_pic" id="auth_pic" class="px-3">
                        <div class="flex w-full gap-2 px-3 my-2 text-xl text-gray-900">
                            <label class="w-1/4 font-bold" for="name">Name:</label>
                            <x-dashboard.input name="name"/>
                        </div>
                    </div>
                </header>

                <main class="relative z-30 flex flex-col items-center justify-center w-full">
                    <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                        <table class="text-lg">
                            <tr>
                                <td class="p-2"><label for="birth_year" class="md:whitespace-nowrap">Year of birth:</label></td>
                                <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                    <x-dashboard.input name="birth_year"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><label for="death_year" class="md:whitespace-nowrap">Year of death:</label></td>
                                <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                    <x-dashboard.input name="death_year"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="flex items-start p-2"><label for="excerpt">Excerpt:</label></td>
                                <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                    <textarea name="excerpt" id="excerpt" class="w-full px-2 py-1 text-base bg-gray-100 border-2 border-gray-300 rounded-md focus:outline-none focus:border-gray-500" rows="4">{{ old('description') }}</textarea>
                                </td>
                            </tr>
                        </table>
                        @foreach ($errors->all() as $error)
                            <p class="w-full text-center text-red-400 o">* {{ $error }}</p>
                        @endforeach
                        @if (session('error'))
                            <p class="w-full text-center text-red-400 o">* {{ session('error') }}</p>
                        @endif
                        <div class="flex justify-end p-2">
                            <button type="submit" class="p-2 rounded-md bg-bgcolor-850">
                                Add author
                            </button>
                        </div>
                    </div>
                </main>
            </form>

            <form action="/authors/create?" method="GET">
                <label for="search" class="block w-full p-2 textlg">Get an author to edit by name:</label>
                <x-dashboard.input name="search" type="text" value="" />
                <div class="flex justify-center">
                    <button class="px-3 py-2 my-2 rounded-md bg-bgcolor-950">
                        Submit
                    </button>
                </div>
            </form>

            @if ($authors ?? false)
                <ul>
                    <li>There are {{ $authors->count() }} with the same name:</li>
                    @foreach ($authors as $author)
                        <li class="my-2">
                            <a href="{{ $author->id }}/edit" class="flex px-3 py-1 text-lg bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200 justify-evenly">
                                <p>{{ $author->name }}</p>
                                <p>{{ $author->birth_year }}</p>
                                <p>{{ $author->death_year }}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif

        </section>

    </section>

</x-layout>
