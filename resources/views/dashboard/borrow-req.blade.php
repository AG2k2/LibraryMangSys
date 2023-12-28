<x-layout>

    <x-dashboard.layout page='requests'>

        <div class="flex w-full">

            <form action="/dashboard/borrow" method="GET" class="flex flex-col items-center w-full gap-3 p-3 bg-bgcolor-850 ">

                <div class="w-full p-1">
                    <x-dashboard.label name="stdntSearch" value="Search for a student by name:" />
                    <x-dashboard.input name="stdntSearch" />
                </div>

                <button type="submit" class="px-2 py-1 text-white bg-gray-900 rounded-lg">Search for student</button>

            </form>

            <form action="/dashboard/borrow" method="GET" class="flex flex-col items-center w-full gap-3 p-3 bg-bgcolor-850 ">
                <div class="w-full p-1">

                    <x-dashboard.label name="bkSearch" value="Search for a book by name:" />

                    <x-dashboard.input name="bkSearch" />

                </div>
                <button type="submit" class="px-2 py-1 text-white bg-gray-900 rounded-lg">Search for book</button>
            </form>

        </div>

        <div class="p-2 my-3 text-xl rounded-md bg-bgcolor-850">
            <div class="flex justify-between p-3">
                <h3>Borrows need to be submitted:</h3>
            </div>
            <ul>
                <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                    <p class="col-span-2 col-start-2">Borrowed By</p>
                    <p class="col-span-2">ID</p>
                    <p class="col-span-3">Book name</p>
                    <p class="col-span-2">DDC</p>
                </li>
                @foreach ($requests as $request)

                    <li class="grid w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                        <p class="inline-flex items-center col-span-1 text-[0.8rem] truncate text-start">
                            {{ $request->created_at->format('Y-m-d') }}:
                        </p>

                        <p class="col-span-2 truncate">
                            <a href="dashboard/students/?search={{ $request->user->first_name . ' ' . $request->user->last_name }}" class="hover:underline"
                                >{{ $request->user->first_name . ' ' . $request->user->last_name }}</a>
                            </p>

                            <p class="col-span-2 truncate">
                                <a href="/books/{{ $request->book->ISBN }}" class="hover:underline"
                                    >{{ $request->user_id }}</a>
                        </p>

                        <p class="col-span-3 truncate">
                            <a href="/books/{{ $request->book->ISBN }}" class="hover:underline"
                                >{{ $request->book->title }}</a>
                        </p>

                        <p class="col-span-2 truncate">
                            {{ $request->book->DDC }}
                        </p>

                        <form action="/dashboard/borrow/{{ $request->id }}" method="POST" class="col-cpan-1">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full text-green-500 hover:underline">Submit</button>
                        </form>

                        <form action="/dashboard/borrow/{{ $request->id }}" method="POST" class="col-cpan-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full text-red-500 hover:underline">Decline</button>
                        </form>


                    </li>

                @endforeach
            </ul>
            {{ $requests->links('dashboard.pagination') }}
        </div>

    </x-dashboard.layout>

</x-layout>
