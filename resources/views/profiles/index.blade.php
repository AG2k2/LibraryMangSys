<?php $user = Auth::user() ?>
<x-layout>

    <section class="flex flex-col items-center justify-center w-full p-2 pt-8 mb-auto md:p-4 lg:p-6">

        <header class="absolute z-50 flex flex-col items-center justify-center top-10">
            <h3 class="my-3 text-3xl">
                {{ ucwords($user->first_name . ' ' . $user->last_name) }}
            </h3>
            <img src="{{ asset('storage/' . $user->pro_pic) }}" alt="#" class="relative border-4 rounded-full border-bgcolor-850 w-52 h-52 bg-bgcolor-850">
            <h3 class="text-lg text-gray-700 ">
                {{ '@'. $user->username  }}
            </h3>
            <p class="text-base">
                ({{ $user->role }})
            </p>
            <a href="{{ route('profileEdit', $user->username) }}"></a>
        </header>

        <main class="relative z-30 flex flex-col items-center justify-center w-full pt-44 md:pt-36 lg:pt-36 md:w-9/12 lg:w-7/12">
            <div class="w-full p-3 border bg-bgcolor-700 rounded-xl border-bgcolor-850 pt-44">
                <table class="text-lg">
                    <tr>
                        <td class="p-2">Gender:</td>
                        <td class="w-full p-2 pl-4 rounded-t-xl bg-bgcolor-800">{{ $user->gender == 'm' ? 'Male' : 'Female' }}</td>
                    </tr>
                    <tr>
                        <td class="p-2">Email:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $user->email }}
                            <span class="p-1 text-sm text-black rounded-xl {{ $user->email_verified_at == null ? 'bg-red-400' : '' }}">{{ $user->email_verified_at == null ? 'unverified' : '' }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap">Birth date:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800">
                            {{ $user->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <td class="p-2 md:whitespace-nowrap">Joined:</td>
                        <td class="w-full p-2 pl-4 bg-bgcolor-800 rounded-b-xl">
                            {{ $user->created_at->diffForHumans() }}
                        </td>
                    </tr>
                </table>
            </div>
        </main>

    </section>

</x-layout>
