<x-layout>

    <x-dashboard.layout page="guests">

        <div class="flex w-full">
            <form action="/dashboard/guests" method="GET" class="flex flex-col items-center w-full gap-3 p-3 bg-bgcolor-850 ">
                <div class="w-full p-1">
                    <x-dashboard.label name="stdntSearch" value="Search for a student:" />
                    <x-dashboard.input name="stdntSearch" />
                </div>

                <button type="submit" class="px-2 py-1 text-white bg-gray-900 rounded-lg">
                    Search for a guest:
                </button>
            </form>
            <form action="/dashboard/guests" method="GET" class="flex flex-col items-center w-full gap-3 p-3 bg-bgcolor-850 ">
                <div class="w-full p-1">
                    <x-dashboard.label name="bkSearch" value="Search for a book:" />
                    <x-dashboard.input name="bkSearch" />
                </div>

                <button type="submit" class="px-2 py-1 text-white bg-gray-900 rounded-lg">
                    Search for a book
                </button>
            </form>
        </div>

        <div class="p-2 my-3 text-xl rounded-md bg-bgcolor-850">
            <div class="flex justify-between p-3">
                <h3>Last borrows operation:</h3>
            </div>
            <ul>
                <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                    <p class="col-span-2">Borrowed By</p>
                    <p class="col-span-3">Card ID:</p>
                    <p class="col-span-2">Book name</p>
                    <p class="col-span-2">ISBN:</p>
                    <p class="col-span-1">State</p>
                    <p class="col-span-1">Borrow date</p>
                    <p class="col-span-1">Return date</p>
                </li>
                @if ($borrows->isEmpty())
                    <li>
                        <p>No books is taken.</p>
                    </li>
                @endif
                @foreach ($borrows as $borrow)
                    <li class="grid w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">


                        <p class="col-span-2 truncate">
                            <a href="dashboard/students/?search={{ $borrow->first_name . ' ' . $borrow->last_name }}" class="hover:underline"
                                >{{ $borrow->first_name . ' ' . $borrow->last_name }}</a>
                        </p>

                        <p class="col-span-3 truncate">
                            <a href="dashboard/students/?search={{ $borrow->first_name . ' ' . $borrow->last_name }}" class="hover:underline"
                            >{{ $borrow->card_id }}</a>
                        </p>

                        <p class="col-span-2 truncate">
                            <a href="/books/{{ $borrow->book->ISBN }}" class="hover:underline"
                                >{{ $borrow->book->title }}</a>
                        </p>

                        <p class="col-span-2 truncate">
                            <a href="/books/{{ $borrow->book->ISBN }}" class="hover:underline"
                                >{{ $borrow->book->ISBN}}</a>
                        </p>

                        <p class="col-span-1 text-sm {{ $borrow->return_at != null ?'text-green-500' : 'text-red-500' }}">{{ $borrow->return_at != null ? 'returned' : 'not returned' }}</p>

                        <p class="col-span-1 text-sm">{{ date('Y-m-d', strtotime($borrow->taken_at)) }}</p>

                        <p class="col-span-1 text-sm">{{ date('Y-m-d', strtotime($borrow->taken_at) + 60*60*24*7*2) }}</p>
                    </li>
                @endforeach
            </ul>
            {{ $borrows->links() }}
        </div>

    </x-dashboard.layout>
</x-layout>
