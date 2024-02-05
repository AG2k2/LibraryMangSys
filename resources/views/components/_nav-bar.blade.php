<nav class="justify-between hidden w-full px-4 pt-1 pb-0 bg-bgcolor-950 md:flex">
    <ul class="flex gap-1">
        <x-nav-item route="booksIndex" value="Books" req="books"/>
        <x-nav-item route="authorsIndex" value="Authors" req="authors"/>
        @auth
            @if (in_array(auth()->user()->role, ['manager', 'libirarian']) )
                <x-nav-item route="dashboard" value="Dashboard" req="dashboard" />
            @endif
        @endauth
    </ul>
    @auth
        @if (in_array(auth()->user()->role, ['manager']) )
            <ul class="flex gap-1">
                <x-nav-item route="management" value="Management" req="management"/>
            </ul>
        @endif
    @endauth
    <ul class="flex gap-1">
        @guest
            <x-nav-item route="login" value="Log In" req="login"/>
            <x-nav-item route="register" value="Sign up" req="signup"/>
        @endguest
        @auth
            <x-nav-item route="profile" value="{{ auth()->user()->username }}" req="profile" />
            <form action="/logout" method="POST" class="flex items-center ml-2">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        @endauth
    </ul>
</nav>
