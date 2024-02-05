<nav class="sticky top-0 flex-col hidden w-full col-span-3 col-start-1 gap-1 p-1 text-lg max-h-[100vh] md:flex">
    <form action="?" method="GET" class="flex my-2">
        <input type="text" name="search" id="search" placeholder="Something in mind?" class="w-9/12 px-3 py-1 text-base border border-r-0 border-gray-300 rounded-l-full">
        <button type="submit" class="w-3/12 px-3 py-1 bg-white border border-l-0 border-gray-300 rounded-r-full hover:text-gray-700 hover:cursor-pointer"><i class="fa fa-search"></i></button>
    </form>
    <h3 class="w-full py-1 text-xl font-bold text-gray-900">Categories:</h3>
    <main class="flex flex-col w-full h-full gap-1 overflow-auto bg-white rounded-lg bg-opacity-40 scrollbar-thin scrollbar-thumb-rounded-full">
        @foreach ($categories as $category)
            <a href="?category={{ $category->slug }}" class="block w-full px-4 py-1 text-gray-900 rounded-md hover:bg-bgcolor-900 {{ request('category') == $category->slug ? 'bg-bgcolor-900' : '' }} first-letter:uppercase ">{{ $category->name }}</a>
        @endforeach
    </main>
</nav>
