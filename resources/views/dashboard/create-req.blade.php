<x-layout>

    <x-dashboard.layout page="Sign a borrow" >

        <h1 class="p-2 my-1 text-xl font-bold text-center rounded-md bg-bgcolor-850">
            Sign a new borrowing request.
        </h1>

        <div class="p-2 my-1 text-xl rounded-md bg-bgcolor-850">

            <form action="/dashboard/borrow" method="POST" class="flex flex-col w-full gap-3 p-3">
                @csrf

                <div class="flex flex-col gap-3">

                    <div class="grid grid-cols-12 items-center justify-center w-7/12 gap-3 p-10 mx-auto border-2 border-[#9d8d6f] bg-[#ddc69a] rounded-xl shadow-md">
                        <h3 class="col-span-12 px-3 my-3 font-bold text-center">Borrower information:</h3>

                        <label for="first_name" class="col-span-3 whitespace-nowrap">First name:</label>
                        <x-dashboard.input name='first_name' class="col-span-3" />

                        <label for="last_name" class="col-span-3 text-center whitespace-nowrap">Last name:</label>
                        <x-dashboard.input name='last_name' class="col-span-3" />

                        <label for="address" class="col-span-3 whitespace-nowrap">Address:</label>
                        <x-dashboard.input name='address' class="col-span-9" />

                        <label for="birth_date" class="col-span-3 whitespace-nowrap ">Birth date:</label>
                        <x-dashboard.input name='birth_date' class="col-span-9" type="date"/>

                        <label for="birth_date" class="col-span-3 whitespace-nowrap ">Gender:</label>
                        <select name="gender" id="gender" class="col-span-9 px-2 py-1 text-base bg-gray-100 border-2 border-gray-300 rounded-md focus:outline-none focus:border-gray-500">
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>

                        <label for="occupation" class="col-span-3 whitespace-nowrap ">Occupation:</label>
                        <x-dashboard.input name='occupation' class="col-span-9"/>

                        <label for="phone_no" class="col-span-3 whitespace-nowrap ">Phone no.:</label>
                        <x-dashboard.input name='phone_no' class="col-span-9"/>

                        <label for="card_id" class="col-span-3 whitespace-nowrap ">ID:</label>
                        <x-dashboard.input name='card_id' class="col-span-9" />

                        <select name="user" id="user" class="w-full col-span-4 m-auto rounded-md">
                            <option value="guest" selected >Guest</option>
                            <option value="enrolled" >Enrolled</option>
                        </select>

                        @if (session('error'))
                            <p class="col-span-12 text-base text-red-500">* {{ session('error') }}</p>
                        @endif
                    </div>

                    <div class="grid grid-cols-12 items-center justify-center w-7/12 gap-3 p-10 mx-auto border-2 border-[#9d8d6f] bg-[#ddc69a] rounded-xl shadow-md">

                        <h3 class="col-span-12 px-3 my-3 font-bold">Book information:</h3>

                        <label for="ISBN" class="col-span-3 whitespace-nowrap">ISBN:</label>
                        <x-dashboard.input name='ISBN' class="col-span-9"/>

                        @if (session('error'))
                            <p class="col-span-12 text-base text-red-500">* {{ session('error') }}</p>
                        @endif
                    </div>

                    <div class="w-7/12 m-auto">
                        @foreach ($errors->all() as $error)
                            <p class="text-base text-red-500">* {{ $error }}</p>
                        @endforeach
                    </div>

                </div>

                <button type="submit" id="submit" class="w-1/4 px-3 py-2 mx-auto mt-3 text-center text-white bg-gray-900 rounded-md hover:bg-gray-950">Sign</button>

            </form>

        </div>

    </x-dashboard.layout>

</x-layout>
