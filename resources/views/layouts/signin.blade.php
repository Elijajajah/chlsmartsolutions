<x-default>
    <section class="min-h-screen flex items-center py-18 bg-black px-6 md:px-36 relative">
        <a href="/" class="absolute top-8 left-10 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </a>
        <div class="flex w-full md:border md:border-[#575757] rounded-3xl relative overflow-hidden font-montserrat">
            <div class="w-full md:w-1/2 md:bg-[#1E1E1E] flex flex-col gap-6 text-center text-white px-4 md:px-26">
                <div class="flex flex-col mt-[25%] gap-2">
                    <h1 class="text-2xl md:text-3xl font-bold !tracking-widest">
                        Sign in
                    </h1>
                    <p class="text-[0.6rem] md:text-[0.8rem] font-extralight">Enter your information to sign in to your
                        account </p>
                </div>
                <div class="flex flex-col items-center pt-4 pb-6 px-10 gap-4">
                    <div
                        class="w-full flex items-center justify-center gap-2 py-2 px-8 border border-[#D1D1D180] rounded-lg">
                        <img class="h-5 md:h-6" src="{{ asset('images/google_icon.png') }}" alt="google_icon.png">

                        <p class="text-[0.7rem] md:text-xs font-semibold">Sign in with Google</p>
                    </div>
                    <div class="flex items-center justify-center relative w-full">
                        <p class="z-10 px-3 bg-black md:bg-[#1E1E1E] text-[0.6rem] font-light">or Sign in with your
                            Account</p>
                        <div class="absolute left-0 top-1/2 bg-white w-full h-[0.5px]"></div>
                    </div>
                </div>
                <form action="/signin" method="POST" class="flex flex-col text-start">
                    @csrf
                    <label for="username" class="block mb-2 text-sm text-white">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}"
                        class="outline outline-[#E0E0E0] w-full rounded-md px-3 py-2 bg-transparent text-white mb-4" />
                    <label for="password" class="block mb-2 text-sm text-white">Password</label>
                    <input id="password" type="password" name="password"
                        class="outline outline-[#E0E0E0] w-full rounded-md px-3 py-2 bg-transparent text-white" />

                    <button
                        class="w-full text-sm md:text-base cursor-pointer font-semibold mt-8 bg-[#5AA526] rounded-lg py-2"
                        type="submit">Sign
                        in</button>
                </form>

                <p class="text-xs font-light mb-[25%]">Don't have an account yet? <span class="text-[#5B81FC]"><a
                            href="/signup">Sign
                            up</a></span></p>
            </div>
            <div class="hidden md:block z-50 absolute left-1/2 top-0 bottom-0 w-px border border-[#575757]"></div>

            <div class="hidden md:block relative w-1/2">
                <div class="absolute inset-0 z-10 backdrop-blur-md"></div>
                <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[40%] bg-[#5AA526] rounded-t-full shadow-xl z-0">
                </div>

                <div class="relative z-20 h-full py-22 flex flex-col gap-2 justify-end items-center text-white">
                    <div class="flex items-center gap-2">
                        <img class="h-6" src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo.png">
                        <p class="text-sm font-semibold">CHL SmartSolutions</p>
                    </div>
                    <p class="text-3xl font-semibold !tracking-widest">Welcome Back!</p>
                    <p class="text-sm font-light">Please enter your details</p>
                    <button class="bg-white mt-6 px-16 py-4 rounded-lg text-black text-xs shadow-md">
                        Sign in to you account
                    </button>

                </div>

            </div>

        </div>
    </section>
</x-default>
