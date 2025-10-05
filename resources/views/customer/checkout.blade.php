<x-default>
    <div class="w-full bg-[#F4F5F9] md:h-screen pb-7">
        <nav class="px-6 md:px-24 flex items-center w-full gap-4 font-inter py-6">
            <a href="/" class="flex items-center gap-2 md:gap-4">
                <img src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo" class="w-10 md:w-8">
                <h1 class="flex items-center text-lg font-bold gap-2">
                    CHL
                    <span class="md:hidden flex">SS</span>
                    <span class="hidden md:flex">SmartSolutions</span>
                </h1>
            </a>
            <div class="flex items-center relative">
                <div class="absolute top-0 left-0 bg-[#5AA526] w-px h-full"></div>
                <p class="text-[#5AA526] font-bold text-lg px-4">Checkout</p>
            </div>
        </nav>
        <hr class="mx-4 md:mx-18 mb-4 md:mb-7 border-t border-[#DCDCDC]">
        <div class="px-6 md:px-24 flex flex-col md:flex-row w-full gap-4 md:gap-2">
            <div class="w-full md:w-[65%] flex flex-col gap-2">
                <div class="bg-white flex flex-col rounded-sm p-6 gap-2 md:gap-0">
                    <p class="text-[#9E9E9E] font-inter">Customer information</p>
                    <div class="flex items-center justify-between">
                        <div
                            class="flex flex-col md:flex-row md:items-center font-medium font-poppins text-sm md:gap-4">
                            <p>{{ $user->fullname }}</p>
                            <p>(+63) {{ $user->phone_number }}</p>
                        </div>
                        <div class="border border-[#5AA526] text-[#5AA526] text-[0.7rem] p-1 rounded-sm">
                            Default
                        </div>
                    </div>
                </div>
                <div
                    class="bg-white rounded-sm py-4 px-6 flex text-[#6F6F6F] font-inter font-semibold text-sm md:text-base">
                    <div class="item-center w-[70%] md:w-[55%] flex gap-1.5">
                        <p>Products</p>
                        <p class="hidden md:block">Ordered</p>
                    </div>
                    <div class="text-center w-[30%] md:w-[22%]">Quantity</div>
                    <div class="text-center hidden md:block md:w-[23%]">Total Price
                    </div>
                </div>
                <div class="bg-white rounded-sm max-h-[335px] overflow-hidden overflow-y-auto custom-scrollbar">
                    <div class="w-full px-6">
                        @foreach ($cartItems as $item)
                            <div class="flex items-center border-b border-[#DCDCDC] last:border-none py-4">
                                <div class="w-[78%] md:w-[55%] font-poppins">
                                    <div class="flex items-center gap-3">
                                        <img class="block h-18 object-cover"
                                            src="{{ asset('storage/' . $item->image_url) }}" alt="">
                                        <div class="flex flex-col items-start">
                                            <h1 class="text-sm md:text-base font-bold line-clamp-1">{{ $item->name }}
                                            </h1>
                                            <p class="font-light text-[0.7rem] md:text-xs line-clamp-2">
                                                {{ $item->description }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="w-[22%] md:w-[22.5%] text-center font-inter font-semibold text-sm md:text-base">
                                    x{{ $item->quantity }}
                                </div>
                                <div class="hidden md:block md:w-[22.5%] text-center font-inter font-semibold">
                                    ₱{{ number_format($item->quantity * $item->price, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="w-full md:w-[35%] h-fit bg-white rounded-sm flex flex-col p-6 gap-8">
                <div class="flex flex-col w-full font-inter">
                    <h1 class="font-bold text-xl">Order Summary</h1>
                    <hr class="w-full h-px my-4 border-[#DCDCDC]">
                    <div class="flex items-center justify-between">
                        <p class="text-[#8C8C8C] text-sm md:text-base">Total ({{ count($cartItems) }} items):</p>
                        <p class="font-semibold">₱{{ number_format($total, 2) }}</p>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <h1 class="font-bold text-lg font-inter">Select Payment Method</h1>
                    <form method="POST" action="/order">
                        @csrf
                        <input type="text" class="hidden" name="total_amount" value="{{ $total }}">
                        <input type="text" class="hidden" name="type" value="online">
                        <label class="block w-full cursor-pointer relative ">
                            <input type="radio" name="payment_method" value="in_store" class="peer hidden">
                            <div
                                class="flex flex-col w-full rounded-md border border-[#D6D6D6] font-poppins py-2 mt-4 peer-checked:border-[#0097B8] transition-all cursor-pointer">

                                <div class="flex items-center gap-4 py-1 px-4">
                                    <img class="h-8 min-w-9" src="{{ asset('images/customer/in_store.png') }}"
                                        alt="">
                                    <p class="text-[#5E5E5E] font-medium">In-store Payment</p>
                                </div>
                                <hr class="w-full border-[#D6D6D6] h-px my-1">
                                <p class="text-[#8C8C8C] text-[0.7rem]  px-4">Pay when you pick-up</p>
                            </div>
                            <div
                                class="absolute top-4 right-4 size-5 rounded-full border border-black peer-checked:hidden">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0097B8"
                                class="absolute top-[0.8rem] right-[0.8rem] w-[1.65rem] h-[1.65rem] hidden peer-checked:block">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </label>

                        <label class="block w-full cursor-pointer relative ">
                            <input type="radio" name="payment_method" value="e-wallet" class="peer hidden">
                            <div
                                class="flex flex-col w-full rounded-md border border-[#D6D6D6] font-poppins py-2 mt-4 peer-checked:border-[#0097B8] transition-all cursor-pointer">

                                <div class="flex items-center gap-4 py-1 px-4">
                                    <img class="h-8 min-w-9" src="{{ asset('images/customer/gcash-logo.png') }}"
                                        alt="">
                                    <div class="text-[#5E5E5E] font-medium flex items-center gap-2">
                                        <p>G-cash</p>
                                        <div class="border-l border-[#5E5E5E] pl-2">
                                            e-Wallet
                                        </div>
                                    </div>
                                </div>
                                <hr class="w-full border-[#D6D6D6] h-px my-1">
                                <p class="text-[#8C8C8C] text-[0.7rem]  px-4">Pay through online payment</p>
                            </div>
                            <div
                                class="absolute top-4 right-4 size-5 rounded-full border border-black peer-checked:hidden">
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0097B8"
                                class="absolute top-[0.8rem] right-[0.8rem] w-[1.65rem] h-[1.65rem] hidden peer-checked:block">
                                <path fill-rule="evenodd"
                                    d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </label>

                        <button type="submit"
                            class="cursor-pointer w-full bg-black font-poppins font-semibold text-lg text-white py-2 rounded-md mt-6">
                            Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>


</x-default>
