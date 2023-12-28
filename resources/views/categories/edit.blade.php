<x-layout>

    <section class="flex items-start w-full p-2 pt-8 mb-auto justify-evenly md:p-4 lg:p-6">

        <x-mngmnt-navbar />

        <main class="w-7/12">

            <form action="{{ route('categoriesUpdate', $category->slug) }}" method="POST" class="w-full" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <h1 class="px-5 py-2 mb-5 text-xl text-center rounded-md bg-bgcolor-950">Edit category "{{ $category->name }}"</h1>

                <main class="relative z-30 flex flex-col items-center justify-center w-full">
                    <div class="relative flex flex-col items-start w-full h-full gap-2">

                        <div class="flex w-full gap-2 px-3 my-2 text-xl text-gray-900">
                            <label class="w-1/4 font-bold" for="name">Name:</label>
                            <x-dashboard.input name="name" type="text" value="{{ $category->name }}"/>
                        </div>

                        <div class="flex w-full gap-3 px-3 my-2 text-xl text-gray-900">
                            <label for="slug" class="w-1/4 font-bold">Slug:</label>
                            <x-dashboard.input name="slug" value="{{ $category->slug }}"/>
                        </div>

                    </div>

                    @foreach ($errors->all() as $error)
                        <p class="w-full text-center text-red-400 o">* {{ $error }}</p>
                    @endforeach
                    @if (session('error'))
                        <p class="w-full text-center text-red-400 o">* {{ session('error') }}</p>
                    @endif

                    <div class="flex justify-end p-2">
                        <button type="submit" class="p-2 rounded-md bg-bgcolor-850">
                            Update category
                        </button>
                    </div>
                </main>
            </form>

            <h3 class="w-full my-5 text-2xl text-center">Or</h3>

            <form action="/categories/create?" method="GET">

                <label for="slug" class="block w-full p-2 textlg">Get a category to edit by slug:</label>
                <x-dashboard.input name="slug" type="text" value="" />
                <div class="flex justify-center">
                    <button class="px-3 py-2 my-2 rounded-md bg-bgcolor-950">
                        Submit
                    </button>
                </div>

            </form>

        </main>

    </section>

</x-layout>
