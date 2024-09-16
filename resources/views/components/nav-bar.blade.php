<nav class="bg-gray-600 grid grid-cols-2">
    <div class="w-16 h-16 flex ml-2">
        <img src="{{asset("images/logo.jpeg")}}" alt="logo" class="rounded-full flex">
        <h3 class="flex pt-4 pl-2 text-white font-bold text-3xl">Smarty <span class="text-amber-400">Quiz</span></h3>
    </div>

    <div class="flex justify-end pt-3 font-bold">
        <a
            href="{{url('/')}}"
            class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Home
        </a>
        @if (Route::has('login'))
            @auth
                <a
                    href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Dashboard
                </a>
            @else
                <a
                    href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Log in
                </a>

                @if (Route::has('register'))
                    <a
                        href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                    >
                        Register
                    </a>
                @endif
            @endauth
        @endif
    </div>


</nav>
