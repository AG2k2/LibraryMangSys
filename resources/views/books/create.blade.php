<x-layout>

    <section class="flex items-start w-full p-2 pt-8 mb-auto justify-evenly md:p-4 lg:p-6">

        <x-mngmnt-navbar />

        <section class="flex flex-col w-8/12 gap-5 p-4 shadow-lg">

            <form action="/books" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf

                <h1 class="px-5 py-2 mb-5 text-xl text-center rounded-md bg-bgcolor-950">Add a new book</h1>

                <header class="z-50 flex items-end justify-start gap-3 mb-5 reltive">
                    <div class="relative flex flex-col items-start w-full h-full gap-2">
                        <input type="file" name="cover" id="cover" class="px-3">
                        <div class="flex w-full gap-2 px-3 my-2 text-xl text-gray-900">
                            <label class="w-1/4 font-bold" for="title">Title:</label>
                            <x-dashboard.input name="title"/>
                        </div>
                        <div class="flex w-full gap-3 px-3 my-2 text-xl text-gray-900">
                            <label for="title" class="w-1/4 font-bold">Author:</label>
                            <x-dashboard.input name="author"/>
                        </div>
                    </div>
                </header>

                <main class="relative z-30 flex flex-col items-center justify-center w-full">
                    <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850">
                        <table class="text-lg">
                            <tr>
                                <td class="p-2"><label for="ISBN">ISBN:</label></td>
                                <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                    <x-dashboard.input name="ISBN"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><label for="DDC">DDC:</label></td>
                                <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">
                                    <x-dashboard.input name="DDC"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="flex items-start p-2"><label for="description">Description:</label></td>
                                <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                    <textarea name="description" id="description" class="w-full px-2 py-1 text-base bg-gray-100 border-2 border-gray-300 rounded-md focus:outline-none focus:border-gray-500" rows="4">{{ old('description') }}</textarea>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2"><label for="published_at">Publish date:</label></td>
                                <td class="w-full p-2 pl-4 bg-bgcolor-800">
                                    <x-dashboard.input name="published_at"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2 md:whitespace-nowrap">
                                    <label for="copies_no">Number of copies:</label>
                                </td>
                                <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                                    <x-dashboard.input name="copies_no" type="number"/>
                                </td>
                            </tr>
                            <tr>
                                <td class="p-2 md:whitespace-nowrap">
                                    <label for="categories">Categories</label>
                                </td>
                                <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                                    <x-dashboard.input name="categories" placeholder="Insert categories slugs seperated by -"/>
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
                                Add book
                            </button>
                        </div>
                    </div>
                </main>
            </form>

            <form action="/books/create?" method="GET">

                <label for="search" class="block w-full p-2 textlg">Get a book to edit by ISBN:</label>
                <x-dashboard.input name="search" type="text" value="" />
                <div class="flex justify-center">
                    <button class="px-3 py-2 my-2 rounded-md bg-bgcolor-950">
                        Submit
                    </button>
                </div>

            </form>

        </section>

    </section>

</x-layout>
