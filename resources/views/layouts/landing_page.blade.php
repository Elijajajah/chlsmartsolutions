<x-default>

    <div class="flex flex-col w-full relative">
        <section id="home" class="px-6 md:px-18 md:h-screen md:pb-14 bg-black">
            <div class="flex flex-col gap-8 md:gap-16">
                <x-navbar />

                <header class="flex flex-col items-center gap-10 md:gap-8 font-inter pb-6 md:pb-10">
                    <div class="flex gap-4 md:gap-10">
                        <a href="#home" class="text-white font-inter text-xs md:text-sm">Home</a>
                        <a href="#about" class="text-white font-inter text-xs md:text-sm">About</a>
                        <a href="#products" class="text-white font-inter text-xs md:text-sm">Products</a>
                        <a href="#help" class="text-white font-inter text-xs md:text-sm">Help Center</a>
                        <a href="" class="text-white font-inter text-xs md:text-sm">Offers</a>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col gap-14 md:gap-10 items-center md:items-start py-6 pb-12 md:pb-0">
                            <div class="text-white flex flex-col gap-4 items-center md:items-start">
                                <h1
                                    class="font-bold text-4xl md:text-7xl flex flex-col gap-4 items-center md:items-start">
                                    Tech it Easy
                                    with <span class="flex gap-3">CHL
                                        <span
                                            class="italic bg-gradient-to-r from-[#5AA526] to-[#1e1e1e] bg-clip-text text-transparent">
                                            SmartSolutions
                                        </span></span>
                                </h1>
                                <p class="text-sm md:text-xl">Best place to choose your tech products</p>
                            </div>

                            <div
                                class="inline-block rounded-full p-[2px] bg-gradient-to-r from-[#FBE6E6] to-[#82BC87] w-fit">
                                <a href="">
                                    <div class="rounded-full px-6 py-4 bg-black text-sm text-white font-semibold">
                                        Shop Now
                                    </div>
                                </a>
                            </div>
                        </div>
                        <img class="hidden lg:flex w-5/12" src="{{ asset('images/customer/hero.png') }}" alt="hero.png">
                    </div>
                </header>
            </div>
        </section>

        <section id="about"
            class="px-6 md:px-36 flex flex-col md:flex-row pt-14 md:pt-18 pb-16 md:pb-24 gap-8 md:gap-6 justify-between">
            <div class="flex flex-col w-full md:w-[65%] justify-between">
                <div class="flex flex-col w-full font-inter gap-6 md:py-12 justify-center">
                    <div class="flex flex-col gap-2">
                        <h1 class="font-bold text-3xl md:text-4xl"><span class="text-[#5AA526] italic">About</span> Us
                        </h1>
                        <p class="text-neutral-600 text-sm md:text-md text-justify">located on the 2nd floor of Vanessa
                            Olga
                            Building, Brgy.
                            Malusak, Boac,
                            Marinduque.</p>
                    </div>
                    <div class="flex flex-col gap-6">
                        <h1 class="font-bold text-3xl md:text-4xl">Tech home the <span
                                class="text-[#5AA526]">best</span>.
                        </h1>
                        <p class="text-neutral-600 text-sm md:text-md text-justify">CHL Distribution and IT Solutions is
                            your go-to tech store
                            and IT
                            service provider. We offer a
                            wide range of quality tech products—from gadgets and accessories to essential hardware and
                            software solutions. At CHL, we aim to bring technology closer to you—making it simpler, more
                            accessible, and more effective.</p>
                    </div>

                </div>
                <img class="hidden md:block h-80" src="{{ asset('images/customer/about_2.png') }}" alt="">
            </div>
            <div class="flex md:flex-col md:gap-6 justify-between w-full md:w-auto">
                <img class="h-42 md:h-80 w-[48%] md:w-full" src="{{ asset('images/customer/about_1.png') }}"
                    alt="">
                <img class="h-42 md:h-80 w-[48%] md:w-full" src="{{ asset('images/customer/about_3.png') }}"
                    alt="">
            </div>
        </section>

        <div id="products" class="relative bg-cover bg-center h-48 md:h-96 w-full"
            style="background-image: url('{{ asset('images/customer/product_header.png') }}')">

            <div class="absolute top-4 left-6 md:top-8 md:left-18">
                <p class="text-white text-base md:text-2xl font-semibold">
                    Shop Now
                </p>
            </div>

            <div class="absolute inset-x-0 bottom-[-2rem] flex justify-center px-4">
                <div class="bg-white rounded-xl w-full max-w-6xl px-6 md:px-12 py-4 md:py-6">
                    <h2 class="text-lg md:text-3xl font-bold">
                        PRODUCT <span class="text-[#5AA526]">COLLECTION</span>
                    </h2>
                    <p class="text-xs md:text-base text-gray-500 mt-2">
                        A subheading for this section, as long or as short as you like
                    </p>
                </div>
            </div>
        </div>

        <livewire:customer-browser />

        <section id="help"
            class="px-6 md:px-36 py-12 pb-18 md:pb-22 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex flex-col gap-12 w-full md:w-[55%]">
                <div class="flex flex-col gap-2">
                    <h1 class="font-bold text-3xl md:text-4xl">Get in <span class="text-[#5AA526]">Touch</span>.</h1>
                    <p class="text-neutral-600 text-sm md:text-md">Ask us anything and we would love to hear from you
                    </p>
                </div>
                <livewire:help-form />
            </div>
            <div class="flex flex-col gap-6 items-center">
                <img class="h-76 hidden md:block" src="{{ asset('images/customer/help.png') }}" alt="help.png">
                <div class="flex flex-col gap-4">
                    <div class="flex gap-4">
                        <div class="min-w-8">
                            <svg width="20" height="28" viewBox="0 0 20 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M9.99984 27.3337C9.68873 27.3337 9.42206 27.2448 9.19984 27.067C8.97762 26.8892 8.81095 26.6559 8.69984 26.367C8.27762 25.1225 7.74428 23.9559 7.09984 22.867C6.47761 21.7781 5.59984 20.5003 4.4665 19.0337C3.33317 17.567 2.41095 16.167 1.69984 14.8337C1.01095 13.5003 0.666504 11.8892 0.666504 10.0003C0.666504 7.40032 1.5665 5.20032 3.3665 3.40032C5.18873 1.5781 7.39984 0.666992 9.99984 0.666992C12.5998 0.666992 14.7998 1.5781 16.5998 3.40032C18.4221 5.20032 19.3332 7.40032 19.3332 10.0003C19.3332 12.0225 18.9443 13.7114 18.1665 15.067C17.411 16.4003 16.5332 17.7225 15.5332 19.0337C14.3332 20.6337 13.4221 21.967 12.7998 23.0337C12.1998 24.0781 11.6998 25.1892 11.2998 26.367C11.1887 26.6781 11.0109 26.9225 10.7665 27.1003C10.5443 27.2559 10.2887 27.3337 9.99984 27.3337ZM9.99984 13.3337C10.9332 13.3337 11.7221 13.0114 12.3665 12.367C13.0109 11.7225 13.3332 10.9337 13.3332 10.0003C13.3332 9.06699 13.0109 8.2781 12.3665 7.63366C11.7221 6.98921 10.9332 6.66699 9.99984 6.66699C9.0665 6.66699 8.27762 6.98921 7.63317 7.63366C6.98873 8.2781 6.6665 9.06699 6.6665 10.0003C6.6665 10.9337 6.98873 11.7225 7.63317 12.367C8.27762 13.0114 9.0665 13.3337 9.99984 13.3337Z"
                                    fill="#5AA526" />
                            </svg>
                        </div>


                        <p class="text-neutral-600 text-sm md:text-md">Malusak, Boac, Marinduque</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="min-w-8">
                            <svg width="26" height="28" viewBox="0 0 28 29" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_263_377)">
                                    <path
                                        d="M25.6667 20.4454V24.0704C25.668 24.407 25.6014 24.7401 25.4713 25.0484C25.3411 25.3567 25.1502 25.6335 24.9108 25.861C24.6713 26.0885 24.3887 26.2617 24.0809 26.3695C23.7731 26.4774 23.4469 26.5174 23.1233 26.4871C19.5333 26.0831 16.0848 24.8125 13.055 22.7775C10.2361 20.9223 7.84623 18.4471 6.055 15.5275C4.08331 12.3752 2.85629 8.78623 2.47334 5.05128C2.44418 4.71713 2.48252 4.38036 2.58592 4.06241C2.68932 3.74445 2.8555 3.45228 3.0739 3.20448C3.29229 2.95669 3.55811 2.75872 3.85443 2.62316C4.15074 2.4876 4.47107 2.41743 4.795 2.41711H8.295C8.86119 2.41134 9.41009 2.619 9.83939 3.00138C10.2687 3.38376 10.5491 3.91477 10.6283 4.49544C10.7761 5.65552 11.05 6.79457 11.445 7.89086C11.602 8.32335 11.6359 8.79338 11.5429 9.24526C11.4498 9.69713 11.2337 10.1119 10.92 10.4404L9.43834 11.975C11.0992 15.0001 13.5175 17.5049 16.4383 19.225L17.92 17.6904C18.2372 17.3656 18.6377 17.1417 19.074 17.0453C19.5103 16.9489 19.9641 16.9841 20.3817 17.1467C21.4402 17.5558 22.5399 17.8395 23.66 17.9925C24.2267 18.0753 24.7443 18.371 25.1143 18.8232C25.4843 19.2755 25.6809 19.8528 25.6667 20.4454Z"
                                        stroke="#5AA526" stroke-width="4" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0_263_377">
                                        <rect width="28" height="29" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>

                        <p class="text-neutral-600 text-sm md:text-md">(+63) 241-563-7401</p>
                    </div>
                    <div class="flex gap-4">
                        <div class="min-w-8">
                            <svg width="28" height="26" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M4 20C3.45 20 2.975 19.8083 2.575 19.425C2.19167 19.025 2 18.55 2 18V6C2 5.45 2.19167 4.98333 2.575 4.6C2.975 4.2 3.45 4 4 4H20C20.55 4 21.0167 4.2 21.4 4.6C21.8 4.98333 22 5.45 22 6V18C22 18.55 21.8 19.025 21.4 19.425C21.0167 19.8083 20.55 20 20 20H4ZM12 13L20 8V6L12 11L4 6V8L12 13Z"
                                    fill="#5AA526" />
                            </svg>
                        </div>

                        <p class="text-neutral-600 text-sm md:text-md">chlss@example.com</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="px-2 md:px-4 pb-2 md:pb-4">
            <x-footer />
        </div>

        <livewire:receipt />
    </div>
</x-default>
