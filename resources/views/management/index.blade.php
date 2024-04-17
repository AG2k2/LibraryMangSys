<x-layout>


    <section class="flex items-start w-full p-2 pt-8 mb-auto justify-evenly md:p-4 lg:p-6">

        <x-mngmnt-navbar />

        <div class="w-8/12 p-4 shadow-lg">

            <h1 class="px-5 py-2 mb-5 text-xl text-center rounded-md bg-bgcolor-950">Employees list</h1>

            <div class="p-2 my-3 text-xl rounded-md bg-bgcolor-850">

                {{--=== HEADER ===--}}
                <div class="flex items-center justify-between px-2">

                    <h3 class="p-2">Submitted readers:</h3>

                    {{--=== SORTING LIST ===--}}
                    <x-dashboard.sortby search="stdntSearch">

                        <x-dashboard.sortby-item query="sortBy" value="name" />

                        <x-dashboard.sortby-item query="sortBy" value="card id" />

                        <x-dashboard.sortby-item query="sortBy" value="role" />

                    </x-dashboard.sortby>
                </div>

                <ul>
                    <li class="grid w-full grid-cols-12 my-2 text-base font-bold text-center">
                        <p class="col-span-3 col-start-3">Name</p>
                        <p class="col-span-3">Card ID</p>
                        <p class="col-span-3">role</p>
                    </li>
                    @foreach ($employees as $employee)
                        <li class="grid items-center w-full grid-cols-12 p-1 my-1 text-base text-center bg-gray-200 rounded-md hover:bg-gray-300">

                            <p class="col-span-2 text-[0.8rem] truncate">
                                <time>
                                    {{ $employee->created_at->format('Y / m / d') }}:
                                </time>
                            </p>

                            <p class="col-span-3 truncate">
                                {{ $employee->first_name . ' ' . $employee->last_name }}
                            </p>

                            <p class="col-span-3 truncate">
                                {{ $employee->card_id }}
                            </p>

                            <form action={{ route('employeeRoleUpdate', $employee->id) }} class="col-span-3" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="text" id="role" name="role" value="{{ $employee->role }}" class="w-full text-center bg-transparent">
                            </form>

                            <p class="col-span-1">
                                <a href={{ route('employeeShow', $employee->card_id) }} class="text-sm hover:underline">
                                    More...
                                </a>
                            </p>

                        </li>
                    @endforeach
                    {{ $employees->links() }}
                </ul>
            </div>

        </div>

    </section>


</x-layout>
