<x-layout>

    <x-dashboard.layout page="Sign a borrow" >

        <h1 class="p-2 my-1 text-xl font-bold text-center rounded-md bg-bgcolor-850">
            Sign a new borrowing request.
        </h1>

        <div class="p-2 my-1 text-xl rounded-md bg-bgcolor-850">

            <form action="/dashboard/return" method="POST" class="flex flex-col w-full gap-3 p-3">
                @csrf

                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-12 justify-center gap-3 p-10 mx-auto border-2 border-[#9d8d6f] bg-[#ddc69a] rounded-xl shadow-md w-7/12">
                        <h3 class="col-span-12 px-3 my-3 font-bold text-center">Borrower information:</h3>

                        <label for="card_id" class="col-span-3 whitespace-nowrap ">Card ID:</label>
                        <x-dashboard.input name='card_id' class="col-span-9"/>

                        <select name="type_user" id="type_user" class="col-span-12 px-2 py-1 m-auto bg-gray-100 rounded-md w-fit">
                            <option value="user" selected>Enrolled</option>
                            <option value="guest">Guest</option>
                        </select>

                    </div>

                    <div class="grid grid-cols-12 items-center justify-center w-7/12 gap-3 p-10 mx-auto border-2 border-[#9d8d6f] bg-[#ddc69a] rounded-xl shadow-md">

                        <h3 class="col-span-12 px-3 my-3 font-bold text-center">Book information:</h3>

                        <label for="ISBN" class="col-span-3 whitespace-nowrap">ISBN:</label>
                        <x-dashboard.input name='ISBN' class="col-span-9"/>

                    </div>

                </div>

                <button type="submit" id="submit" class="w-1/4 px-3 py-2 mx-auto mt-3 text-center text-white bg-gray-900 rounded-md hover:bg-gray-950">Return the book</button>

            </form>

        </div>

    </x-dashboard.layout>

</x-layout>
