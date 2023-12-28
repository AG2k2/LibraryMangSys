<x-layout>

    <section class="w-full p-5 my-10 bg-bgcolor-800">
        <main class="relative z-50 w-full m-auto shadow-lg md:w-8/12 lg:w-5/12 rounded-xl">
            <div class="relative z-50 h-full py-4 bg-gray-100 rounded-xl md:w-full">
                <h3 class="relative z-50 p-3 text-xl font-bold text-center">Sign Up!</h3>
                <form action="/register" method="POST" class="relative z-50 flex flex-col justify-center w-full gap-3 p-7">
                    @csrf

                    <x-form.reg-input name="card_id" value="Card ID" length="9" />
                    <x-form.error name="card_id"/>

                    <x-form.reg-input name="first_name" value="First name" />
                    <x-form.error name="first_name"/>

                    <x-form.reg-input name="last_name" value="Last name" />
                    <x-form.error name="last_name"/>

                    <x-form.reg-input name="username" value="Username" />
                    <x-form.error name="username"/>

                    <x-form.reg-input name="email" value="Email" type="email" />
                    <x-form.error name="email"/>

                    <x-form.reg-input name="address" value="Adress" />
                    <x-form.error name="address"/>

                    <div>
                        <label for="gender" class="block mb-1 text-lg">Gender:</label>
                        <select name="gender" id="gender" class="block w-full p-2 bg-gray-200 border border-gray-300 rounded-lg focus:outline-black">
                            <option value="m" selected>Male</option>
                            <option value="f">Female</option>
                        </select>
                    </div>
                    <x-form.error name="gender"/>

                    <x-form.reg-input name="birth_date" value="Date of birth" type="date" min="1920-01-01" max=""/>
                    <x-form.error name="birth_date"/>

                    <x-form.reg-input name="password" value="Password" type="password" />
                    <x-form.error name="password"/>

                    <x-form.reg-input name="password_confirmation" value="Repeat password" type="password" />
                    <x-form.error name="password_confirmation"/>

                    <button type="submit" id="submit" class="px-3 py-2 mx-auto mt-3 text-center text-white bg-gray-900 rounded-md hover:bg-gray-950 w-fit">Sign Up</button>
                </form>
            </div>
            <div class="absolute top-0 z-20 w-full h-full bg-bgcolor-950 rounded-xl rotate-3"></div>
            <div class="absolute top-0 z-10 w-full h-full bg-bgcolor-900 rounded-xl rotate-6"></div>
        </main>
    </section>


</x-layout>
