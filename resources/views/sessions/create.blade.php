<x-layout>

    <section class="w-full p-5 my-auto bg-bgcolor-800">
        <main class="relative z-50 w-full m-auto shadow-lg md:w-8/12 lg:w-5/12 rounded-xl">
            <div class="relative z-50 h-full py-4 bg-gray-100 rounded-xl md:w-full">
                <h3 class="relative z-50 p-3 text-xl font-bold text-center">Login!</h3>
                <form action="/login" method="POST" class="relative z-50 flex flex-col justify-center w-full gap-3 p-7">
                    @csrf
                    <x-form.reg-input name="username" value="username" />
                    <x-form.reg-input name="password" value="password" type="password" />
                    <x-form.error name="username" />
                    <x-form.error name="password" />
                    <button type="submit" id="submit" class="px-3 py-2 mx-6 mt-3 text-white bg-gray-900 rounded-md hover:bg-gray-950 w-fit">Log In</button>

                </form>
            </div>
            <div class="absolute top-0 z-20 w-full h-full bg-bgcolor-950 rounded-xl rotate-3"></div>
            <div class="absolute top-0 z-10 w-full h-full bg-bgcolor-900 rounded-xl rotate-6"></div>
        </main>
    </section>

</x-layout>
