@props(['page'])
<section class="relative grid items-start min-h-full grid-cols-12 p-6 mb-auto">

    <div class="col-span-10 col-start-2 px-4 py-2 my-2 bg-gray-200 rounded-md">
        @if (Route::currentRouteName() !== 'dashboard')
            <p>
                <a class="text-base text-gray-900 hover:underline" href={{ route('dashboard') }}>Dashboard</a>
                > <span class="text-gray-500"> {{ $page }} </span>
            </p>
        @else
            <p class="text-base text-gray-500">Dashboard</p>
        @endif
    </div>


    <nav class="flex col-span-12 my-4 md:col-span-10 md:col-start-2 ">

        <h3 class="relative block h-auto px-3 py-3 text-xl bg-bgcolor-950">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center h-full">Dashboard</a>
        </h3>

        <ul class="inline-flex items-center justify-start overflow-auto text-center align-middle whitespace-nowrap scrollbar-thin">

            <li class="relative h-full text-center w-fit">
                <a href="{{ route('dashboard') }}/books"
                class="inline-flex items-center h-full px-3 py-3 text-lg py-auto bg-bgcolor-700 hover:bg-bgcolor-900"
                >Books</a>
            </li>

            <li class="relative h-full text-center w-fit">
                <a href="{{ route('dashboard') }}/students"
                class="inline-flex items-center w-full h-full px-3 py-3 text-lg bg-bgcolor-700 hover:bg-bgcolor-900"
                >Students</a>
            </li>

            <li class="relative h-full">
                <a href="{{ route('dashboard') }}/submittion"
                class="inline-flex items-center w-full h-full px-3 py-2 text-lg bg-bgcolor-700 hover:bg-bgcolor-900 "
                >Enrollment requests</a>
            </li>

            <li class="relative h-full">
                <a href="{{ route('dashboard') }}/borrow"
                class="inline-flex items-center w-full h-full px-3 py-2 text-lg bg-bgcolor-700 hover:bg-bgcolor-900 "
                >Borrowing requests</a>
            </li>

            <li class="relative h-full">
                <a href="{{ route('dashboard') }}/guests"
                class="inline-flex items-center w-full h-full px-3 py-2 text-lg bg-bgcolor-700 hover:bg-bgcolor-900"
                >Guests borrowings</a>
            </li>

            <li class="relative h-full">
                <a href="{{ route('dashboard') }}/borrow/create"
                class="inline-flex items-center w-full h-full px-3 py-2 text-lg bg-bgcolor-700 hover:bg-bgcolor-900"
                >Sign a borrowing</a>
            </li>

            <li class="relative h-full">
                <a href="{{ route('dashboard') }}/return/create"
                class="inline-flex items-center w-full h-full px-3 py-2 text-lg bg-bgcolor-700 hover:bg-bgcolor-900"
                >Sign a returning</a>
            </li>

        </ul>

    </nav>

    <main class="col-span-12 my-4">

        {{ $slot }}

    </main>

</section>
