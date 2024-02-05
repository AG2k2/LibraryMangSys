<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>LibraryMangSys</title>
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])
</head>
<body class="relative flex flex-col min-h-screen overflow-auto bg-bgcolor-800 font-appfont scrollbar-thin scrollbar-thumb-scrollthumb">

    @include('components._nav-bar')

    {{ $slot }}

    <footer class="flex flex-col w-full gap-5 p-5 mt-auto text-center bg-bgcolor-950">
        <p class="text-xl">Created by: <span class="text-orange-900">Ammar Goher</span> (Backend dev.)</p>
        <p class="text-lg">All rights reserved | Copyright © 2023</p>
    </footer>

    @if (session()->has('success'))
        <div x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed px-4 py-2 text-base text-black bg-bgcolor-900 rounded-xl bottom-3 right-3"
        >
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session()->has('failure'))
        <div x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 4000)"
            x-show="show"
            class="fixed px-4 py-2 text-base text-red-500 bg-bgcolor-900 rounded-xl bottom-3 right-3"
        >
            <p>{{ session('failure') }}</p>
        </div>
    @endif

</body>
</html>
