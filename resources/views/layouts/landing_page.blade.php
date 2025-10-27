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
                        <a href="#help" class="text-white font-inter text-xs md:text-sm">Services</a>
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

        <section id="help">
            <livewire:help-request />
        </section>

        <div class="px-2 md:px-4 pb-2 md:pb-4">
            <x-footer />
        </div>

        <livewire:receipt />
    </div>
</x-default>
