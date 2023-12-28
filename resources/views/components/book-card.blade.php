@props(['book'])
<div class="relative col-span-12 md:col-span-6 lg:col-span-4">

    <div class="relative z-30 h-full p-2 bg-gray-100 border border-gray-300 rounded-md">
        <img src="{{ asset('storage/'.$book->cover) }}" alt="book cover" class="w-6/12 mx-auto md:w-8/12">

        <div class="py-2">
            @foreach ($book->categories as $category)
                <a href="?category={{ $category->slug }}" class="p-1 text-sm rounded-md bg-bgcolor-700 hover:bg-bgcolor-800">{{ $category->name }}</a>
            @endforeach
        </div>

        <h3 class="my-2 text-lg font-bold text-black truncate">
            <a href={{ route('booksShow', $book->ISBN) }}>{{ $book->title }}</a>
        </h3>

        <h3 class="my-2 text-black">{{ $book->author->name }}</h3>

        <time class="my-2 text-xs text-black">{{ $book->published_at }}</time>

        <div>
            @if ($book->available > 0)
                <p class="p-1 my-2 text-sm bg-green-300 rounded-md w-fit">available</p>
            @else
                <p class="p-1 my-2 text-sm bg-red-500 rounded-md w-fit">unavailable</p>
            @endif
        </div>
    </div>

    <div class="absolute top-0 z-20 w-full h-full rounded-md bg-bgcolor-950 -rotate-2"></div>
</div>
