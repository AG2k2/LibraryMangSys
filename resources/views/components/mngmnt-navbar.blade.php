<nav class="w-3/12 shadow-md lg:w-2/12">
    <header>
        <h1 class="px-5 py-2 text-2xl text-center bg-bgcolor-950">Management</h1>
    </header>
    <ul class="text-lg text-center">
        <li class="bg-bgcolor-700">
            <a href="{{ route('management') }}" class="block px-5 py-2">
                Employees
            </a>
        </li>
        <li class="bg-bgcolor-700">
            <a href="{{ route('booksCreate') }}" class="block px-5 py-2">
                Add a book
            </a>
        </li>
        <li class="bg-bgcolor-700">
            <a href="{{ route('categoriesCreate') }}" class="block px-5 py-2">
                Add a category
            </a>
        </li>
        <li class="bg-bgcolor-700">
            <a href="{{ route('authorsCreate') }}" class="block px-5 py-2">
                Add an author
            </a>
        </li>
    </ul>
</nav>
