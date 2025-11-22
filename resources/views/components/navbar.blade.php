<nav x-data="{ open: false }" class="flex items-center justify-between w-full font-inter bg-black py-6 md:px-6 relative">
    <a href="/" class="flex items-center gap-2 md:gap-4 text-white">
        <img src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo" class="w-10 md:w-8">
        <h1 class="flex items-center text-lg font-bold gap-2">
            CHL
            <span class="md:hidden flex">SS</span>
            <span class="hidden md:flex">SmartSolutions</span>
        </h1>
    </a>
    <div class="flex items-center gap-6 md:gap-10">

        <livewire:cart />

        @auth
            <button id="profile-button" @click="open = !open"
                class="rounded-full w-8 h-8 flex items-center justify-between overflow-hidden cursor-pointer">
                <img src="{{ asset('images/profile.png') }}" alt="profile.png">
            </button>
        @else
            <a href="/signin">
                <div class="bg-[#5AA526] px-4 py-2 md:px-6 rounded-xl">
                    <p class="text-white font-bold text-sm">SIGN IN</p>
                </div>
            </a>
        @endauth
    </div>

    <div x-show="open" x-cloak @click.outside="open = false" x-transition
        class="absolute top-18 right-0 p-4 bg-white rounded-md w-38">
        <div class="absolute -top-2 md:-top-2 right-2 md:right-8 w-4 h-4 rotate-45 bg-white flex flex-col"></div>
        <livewire:customer-history />
        <form method="POST" action="/signout">
            @csrf
            <button type="submit" class="cursor-pointer flex items-center gap-2 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
                <p class="text-sm">Sign out</p>
            </button>
        </form>

    </div>

</nav>
