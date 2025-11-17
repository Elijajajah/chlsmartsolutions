<x-default>
    <section class="min-h-screen flex items-center py-18 bg-black px-6 md:px-36 relative">
        <a href="/" class="absolute top-8 left-10 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-7">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </a>

        <div class="flex w-full md:border md:border-[#575757] rounded-3xl relative overflow-hidden font-montserrat">
            <div class="hidden md:block relative w-1/2">
                <div class="absolute inset-0 z-10 backdrop-blur-md"></div>
                <div
                    class="absolute bottom-0 left-1/2 -translate-x-1/2 w-full h-[36%] bg-[#5AA526] rounded-t-full shadow-xl z-0">
                </div>

                <div class="relative z-20 h-full py-22 flex flex-col gap-2 justify-end items-center text-white">
                    <div class="flex items-center gap-2">
                        <img class="h-6" src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo.png">
                        <p class="text-sm font-semibold">CHL SmartSolutions</p>
                    </div>
                    <p class="text-3xl font-semibold !tracking-widest">Get Started with Us</p>
                    <p class="text-sm font-light">Complete these easy steps to register your account</p>
                    <button class="bg-white my-6 px-16 py-4 rounded-lg text-black text-xs shadow-md">
                        Sign up your account
                    </button>
                </div>

            </div>
            <div class="hidden md:block z-50 absolute left-1/2 top-0 bottom-0 w-px border border-[#575757]"></div>

            <div class="w-full md:w-1/2 md:bg-[#1E1E1E] flex flex-col gap-18 text-center text-white px-4 md:px-26">
                <div class="flex flex-col mt-[25%] gap-2">
                    <h1 class="text-2xl md:text-3xl font-bold !tracking-widest">
                        Create Account
                    </h1>
                    <p class="text-[0.6rem] md:text-[0.8rem] font-extralight">Enter your information to create your
                        account
                    </p>
                </div>
                <div class="flex flex-col gap-4">
                    <form action="/signup" method="POST" class="flex flex-col text-start">
                        @csrf
                        <label for="fullname" class="block mb-2 text-sm text-white">Full Name</label>
                        <input id="fullname" type="text" name="fullname" value="{{ old('fullname') }}"
                            class="outline outline-[#E0E0E0] w-full rounded-md px-3 py-2 bg-transparent text-white mb-4" />
                        <label for="username" class="block mb-2 text-sm text-white">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}"
                            class="outline outline-[#E0E0E0] w-full rounded-md px-3 py-2 bg-transparent text-white mb-4" />
                        <div class="relative">
                            <div class="absolute top-9 left-3 text-white flex items-center justify-center gap-2">
                                <p>+63</p>
                                <div class="w-px bg-white h-5"></div>
                            </div>
                            <label for="phone" class="block mb-2 text-sm text-white">Phone number</label>
                            <input id="phone" type="text" name="phone" maxlength="10" inputmode="numeric"
                                value="{{ old('phone', '9') }}"
                                class="outline outline-[#E0E0E0] w-full rounded-md pl-16 pr-3 py-2 bg-transparent text-white mb-4" />
                        </div>
                        <label for="password" class="block mb-2 text-sm text-white">Password</label>
                        <div class="relative w-full">
                            <input id="password" type="password" name="password"
                                class="outline outline-[#E0E0E0] w-full rounded-md px-3 py-2 bg-transparent text-white pr-10"
                                placeholder="Enter your password" />

                            <!-- Toggle Button (Eye Icon) -->
                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-white">
                                <!-- Default: eye-slash -->
                                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-eye-off-icon lucide-eye-off">
                                    <path
                                        d="M10.733 5.076a10.744 10.744 0 0 1 11.205 6.575 1 1 0 0 1 0 .696 10.747 10.747 0 0 1-1.444 2.49" />
                                    <path d="M14.084 14.158a3 3 0 0 1-4.242-4.242" />
                                    <path
                                        d="M17.479 17.499a10.75 10.75 0 0 1-15.417-5.151 1 1 0 0 1 0-.696 10.75 10.75 0 0 1 4.446-5.143" />
                                    <path d="m2 2 20 20" />
                                </svg>

                                <!-- When visible: eye -->
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-eye-icon lucide-eye hidden">
                                    <path
                                        d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        <button
                            class="w-full text-sm md:text-base cursor-pointer font-semibold mt-8 bg-[#5AA526] rounded-lg py-2"
                            type="submit">Sign
                            up</button>
                    </form>

                    <p class="text-xs font-light mb-[25%]">Already have an account? <span class="text-[#5B81FC]"><a
                                href="/signin">Sign
                                in</a></span></p>
                </div>
            </div>
        </div>
    </section>
</x-default>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const passwordField = document.getElementById('password');
        const toggleButton = document.getElementById('togglePassword');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        if (passwordField && toggleButton) {
            toggleButton.addEventListener('click', () => {
                const isHidden = passwordField.type === 'password';
                passwordField.type = isHidden ? 'text' : 'password';
                eyeOpen.classList.toggle('hidden', !isHidden);
                eyeClosed.classList.toggle('hidden', isHidden);
            });
        }
    });
</script>
