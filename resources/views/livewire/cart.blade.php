<div x-data="{ open: false }" class="relative flex items-center">
    <button @click="open = !open" class="relative z-50 cursor-pointer">
        <svg class="size-8 md:size-9" viewBox="0 0 41 39" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M2.20135 4.48993C2.42512 3.85137 3.15072 3.50627 3.82201 3.71913L4.34201 3.884C5.41206 4.22325 6.31633 4.50993 7.02741 4.82458C7.78322 5.15905 8.43904 5.57358 8.93633 6.22986C9.43363 6.88617 9.63965 7.60907 9.73421 8.3969C9.7825 8.79923 9.80457 9.25033 9.81465 9.75033H28.1033C31.6139 9.75033 33.3692 9.75033 34.1288 10.846C34.8883 11.9417 34.1967 13.4764 32.8138 16.5457L32.0818 18.1707C31.4361 19.6037 31.1134 20.3202 30.4715 20.7227C29.8297 21.1254 29.0102 21.1254 27.3711 21.1254H10.0848C10.2642 22.0026 10.5471 22.5161 10.9489 22.8983C11.4217 23.3479 12.0855 23.6412 13.339 23.8014C14.6294 23.9665 16.3397 23.9691 18.7918 23.9691H30.7502C31.4578 23.9691 32.0314 24.5147 32.0314 25.1879C32.0314 25.861 31.4578 26.4066 30.7502 26.4066H18.6981C16.3618 26.4066 14.4787 26.4066 12.9976 26.2172C11.4599 26.0205 10.1652 25.5998 9.13694 24.6217C8.10868 23.6437 7.66639 22.4121 7.45967 20.9494C7.26054 19.5405 7.26056 17.7493 7.26059 15.527V11.1853C7.26059 10.0266 7.25866 9.26002 7.18825 8.67338C7.12159 8.11789 7.00516 7.84994 6.85753 7.6551C6.70989 7.46027 6.47947 7.27047 5.94654 7.03465C5.38373 6.7856 4.61977 6.54141 3.46423 6.17504L3.01168 6.03153C2.34039 5.81869 1.97759 5.12849 2.20135 4.48993ZM13.6668 13.4066C12.9592 13.4066 12.3856 13.9522 12.3856 14.6253C12.3856 15.2984 12.9592 15.8441 13.6668 15.8441H18.7918C19.4994 15.8441 20.0731 15.2984 20.0731 14.6253C20.0731 13.9522 19.4994 13.4066 18.7918 13.4066H13.6668Z"
                fill="white" />
            <path
                d="M12.8125 29.25C14.2277 29.25 15.375 30.3413 15.375 31.6875C15.375 33.0336 14.2277 34.125 12.8125 34.125C11.3973 34.125 10.25 33.0336 10.25 31.6875C10.25 30.3413 11.3973 29.25 12.8125 29.25Z"
                fill="white" />
            <path
                d="M28.1875 29.25C29.6027 29.25 30.75 30.3412 30.75 31.6875C30.75 33.0336 29.6027 34.125 28.1875 34.125C26.7723 34.125 25.625 33.0336 25.625 31.6875C25.625 30.3412 26.7723 29.25 28.1875 29.25Z"
                fill="white" />
        </svg>
        @if ($this->totalItems > 0)
            <div
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
                {{ $this->totalItems }}
            </div>
        @endif
    </button>

    <div x-show="open" x-cloak @click.outside="open = false" x-transition
        class="absolute top-full left-1/2 transform -translate-x-[75%] md:-translate-x-[75%] mt-3 w-[325px] md:w-[700px] max-h-[400px] md:max-h-[550px] bg-[#F5F5F5] rounded-lg shadow-lg z-40 p-4 font-inter">
        <div class="absolute -top-2 md:-top-2 left-[72.5%] md:left-[74%] w-4 h-4 bg-[#F5F5F5] rotate-45 z-[-1]"></div>

        <div class="flex flex-col px-4">
            <h2 class="flex items-center text-xl md:text-3xl font-bold">Your C
                <span class="md:mr-0.5 md:pt-1">
                    <svg class="w-6 h-4 md:w-8 md:h-5" viewBox="0 0 23 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M0.958496 0.833008H4.79183L7.36016 11.9913C7.4478 12.375 7.68782 12.7196 8.03823 12.9649C8.38863 13.2102 8.82708 13.3405 9.27683 13.333H18.5918C19.0416 13.3405 19.48 13.2102 19.8304 12.9649C20.1808 12.7196 20.4209 12.375 20.5085 11.9913L22.0418 4.99967H5.75016M9.5835 17.4997C9.5835 17.9599 9.15443 18.333 8.62516 18.333C8.09589 18.333 7.66683 17.9599 7.66683 17.4997C7.66683 17.0394 8.09589 16.6663 8.62516 16.6663C9.15443 16.6663 9.5835 17.0394 9.5835 17.4997ZM20.1252 17.4997C20.1252 17.9599 19.6961 18.333 19.1668 18.333C18.6376 18.333 18.2085 17.9599 18.2085 17.4997C18.2085 17.0394 18.6376 16.6663 19.1668 16.6663C19.6961 16.6663 20.1252 17.0394 20.1252 17.4997Z"
                            stroke="#5AA526" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>rt
            </h2>
            <p class="text-[#B3B3B3] text-[0.7rem] md:text-xs">You have
                <span class="text-xs md:text-sm text-[#5AA526]">{{ $this->totalItems }}</span>
                items in your Cart
            </p>
        </div>

        <hr class="my-3 border-t border-gray-300" />

        <div class="hidden md:block w-full text-sm mb-4">
            @if ($this->totalItems > 0)
                <table class="w-full mb-2">
                    <thead>
                        <tr class="font-medium text-center text-[#6F6F6F] bg-white text-[0.6rem] text-sm">
                            <th class="px-4 py-2 w-[42%] rounded-l-lg">Product</th>
                            <th class="px-4 py-2 w-[23%]">Quantity</th>
                            <th class="px-4 py-2 w-[19%] text-center">Total Price</th>
                            <th class="px-4 py-2 w-[16%] rounded-r-lg">Action</th>
                        </tr>
                    </thead>
                </table>
            @endif

            <div class="max-h-82 overflow-hidden overflow-y-auto custom-scrollbar">
                <table class="w-full border-separate border-spacing-y-2 text-sm">
                    <tbody>
                        @forelse ($cartItems as $item)
                            <tr class="bg-white">
                                <td class="px-4 py-2 w-[45%] rounded-l-lg">
                                    <div class="flex gap-2">
                                        <div class="w-[40%]">
                                            <img class="w-full rounded-md object-cover"
                                                src="{{ asset('storage/' . $item->image_url) }}" alt="">
                                        </div>
                                        <div class="flex flex-col py-2 w-[60%]">
                                            <h1 class="line-clamp-2 text-[.8rem] font-bold">
                                                {{ $item->name }}</h1>
                                            <p class="line-clamp-1 text-[.7rem] text-[#6F6F6F]">Stock:
                                                {{ $item->stock }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 w-[20%]">
                                    <div
                                        class="flex items-center justify-center border border-gray-300 divide-x divide-gray-300 rounded">
                                        <button
                                            class="cursor-pointer w-10 h-8 flex items-center justify-center hover:bg-gray-100"
                                            wire:click='decreaseQuantity({{ $item->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                                            </svg>
                                        </button>
                                        <div class="w-10 h-8 flex items-center justify-center text-sm font-bold">
                                            {{ $item->quantity }}
                                        </div>
                                        <button
                                            class="cursor-pointer w-10 h-8 flex items-center justify-center hover:bg-gray-100"
                                            wire:click='increaseQuantity({{ $item->id }})'>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 4.5v15m7.5-7.5h-15" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                                <td class="px-4 py-2 w-[20%] text-center font-bold">
                                    ₱{{ number_format($this->totalPrice($item->id), 2) }}
                                </td>
                                <td class="px-4 py-2 w-[15%] text-center rounded-r-lg">
                                    <button class="text-red-500 font-bold cursor-pointer"
                                        wire:click='removeItem({{ $item->id }})'>
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <svg width="130" height="130" viewBox="0 0 41 39" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M2.20135 4.48993C2.42512 3.85137 3.15072 3.50627 3.82201 3.71913L4.34201 3.884C5.41206 4.22325 6.31633 4.50993 7.02741 4.82458C7.78322 5.15905 8.43904 5.57358 8.93633 6.22986C9.43363 6.88617 9.63965 7.60907 9.73421 8.3969C9.7825 8.79923 9.80457 9.25033 9.81465 9.75033H28.1033C31.6139 9.75033 33.3692 9.75033 34.1288 10.846C34.8883 11.9417 34.1967 13.4764 32.8138 16.5457L32.0818 18.1707C31.4361 19.6037 31.1134 20.3202 30.4715 20.7227C29.8297 21.1254 29.0102 21.1254 27.3711 21.1254H10.0848C10.2642 22.0026 10.5471 22.5161 10.9489 22.8983C11.4217 23.3479 12.0855 23.6412 13.339 23.8014C14.6294 23.9665 16.3397 23.9691 18.7918 23.9691H30.7502C31.4578 23.9691 32.0314 24.5147 32.0314 25.1879C32.0314 25.861 31.4578 26.4066 30.7502 26.4066H18.6981C16.3618 26.4066 14.4787 26.4066 12.9976 26.2172C11.4599 26.0205 10.1652 25.5998 9.13694 24.6217C8.10868 23.6437 7.66639 22.4121 7.45967 20.9494C7.26054 19.5405 7.26056 17.7493 7.26059 15.527V11.1853C7.26059 10.0266 7.25866 9.26002 7.18825 8.67338C7.12159 8.11789 7.00516 7.84994 6.85753 7.6551C6.70989 7.46027 6.47947 7.27047 5.94654 7.03465C5.38373 6.7856 4.61977 6.54141 3.46423 6.17504L3.01168 6.03153C2.34039 5.81869 1.97759 5.12849 2.20135 4.48993ZM13.6668 13.4066C12.9592 13.4066 12.3856 13.9522 12.3856 14.6253C12.3856 15.2984 12.9592 15.8441 13.6668 15.8441H18.7918C19.4994 15.8441 20.0731 15.2984 20.0731 14.6253C20.0731 13.9522 19.4994 13.4066 18.7918 13.4066H13.6668Z" />
                                    <path
                                        d="M12.8125 29.25C14.2277 29.25 15.375 30.3413 15.375 31.6875C15.375 33.0336 14.2277 34.125 12.8125 34.125C11.3973 34.125 10.25 33.0336 10.25 31.6875C10.25 30.3413 11.3973 29.25 12.8125 29.25Z" />
                                    <path
                                        d="M28.1875 29.25C29.6027 29.25 30.75 30.3412 30.75 31.6875C30.75 33.0336 29.6027 34.125 28.1875 34.125C26.7723 34.125 25.625 33.0336 25.625 31.6875C25.625 30.3412 26.7723 29.25 28.1875 29.25Z" />
                                </svg>
                                <p class="text-lg">Your cart is empty</p>
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="md:hidden max-h-58 overflow-hidden overflow-y-auto custom-scrollbar mb-4">
            @forelse ($cartItems as $item)
                <div class="flex items-center justify-between relative bg-white w-full rounded-lg py-2 px-4 gap-4 mb-2">
                    <button class="absolute top-2 right-2 text-red-500" wire:click='removeItem({{ $item->id }})'>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <div class="flex items-center">
                        <img class="h-15 w-15 object-cover" src="{{ asset('storage/' . $item->image_url) }}"
                            alt="">
                        <div class="flex flex-col">
                            <h1 class="text-xs font-bold line-clamp-1">{{ $item->name }}</h1>
                            <p class="text-[0.6rem] font-light">Stock: {{ $item->stock }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-1">
                        <button wire:click='decreaseQuantity({{ $item->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                        <p class="text-sm line-clamp-1 text-center w-4">{{ $item->quantity }}</p>
                        <button wire:click='increaseQuantity({{ $item->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center text-gray-400">
                    <svg width="80" height="80" viewBox="0 0 41 39" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M2.20135 4.48993C2.42512 3.85137 3.15072 3.50627 3.82201 3.71913L4.34201 3.884C5.41206 4.22325 6.31633 4.50993 7.02741 4.82458C7.78322 5.15905 8.43904 5.57358 8.93633 6.22986C9.43363 6.88617 9.63965 7.60907 9.73421 8.3969C9.7825 8.79923 9.80457 9.25033 9.81465 9.75033H28.1033C31.6139 9.75033 33.3692 9.75033 34.1288 10.846C34.8883 11.9417 34.1967 13.4764 32.8138 16.5457L32.0818 18.1707C31.4361 19.6037 31.1134 20.3202 30.4715 20.7227C29.8297 21.1254 29.0102 21.1254 27.3711 21.1254H10.0848C10.2642 22.0026 10.5471 22.5161 10.9489 22.8983C11.4217 23.3479 12.0855 23.6412 13.339 23.8014C14.6294 23.9665 16.3397 23.9691 18.7918 23.9691H30.7502C31.4578 23.9691 32.0314 24.5147 32.0314 25.1879C32.0314 25.861 31.4578 26.4066 30.7502 26.4066H18.6981C16.3618 26.4066 14.4787 26.4066 12.9976 26.2172C11.4599 26.0205 10.1652 25.5998 9.13694 24.6217C8.10868 23.6437 7.66639 22.4121 7.45967 20.9494C7.26054 19.5405 7.26056 17.7493 7.26059 15.527V11.1853C7.26059 10.0266 7.25866 9.26002 7.18825 8.67338C7.12159 8.11789 7.00516 7.84994 6.85753 7.6551C6.70989 7.46027 6.47947 7.27047 5.94654 7.03465C5.38373 6.7856 4.61977 6.54141 3.46423 6.17504L3.01168 6.03153C2.34039 5.81869 1.97759 5.12849 2.20135 4.48993ZM13.6668 13.4066C12.9592 13.4066 12.3856 13.9522 12.3856 14.6253C12.3856 15.2984 12.9592 15.8441 13.6668 15.8441H18.7918C19.4994 15.8441 20.0731 15.2984 20.0731 14.6253C20.0731 13.9522 19.4994 13.4066 18.7918 13.4066H13.6668Z" />
                        <path
                            d="M12.8125 29.25C14.2277 29.25 15.375 30.3413 15.375 31.6875C15.375 33.0336 14.2277 34.125 12.8125 34.125C11.3973 34.125 10.25 33.0336 10.25 31.6875C10.25 30.3413 11.3973 29.25 12.8125 29.25Z" />
                        <path
                            d="M28.1875 29.25C29.6027 29.25 30.75 30.3412 30.75 31.6875C30.75 33.0336 29.6027 34.125 28.1875 34.125C26.7723 34.125 25.625 33.0336 25.625 31.6875C25.625 30.3412 26.7723 29.25 28.1875 29.25Z" />
                    </svg>
                    <p>Your cart is empty</p>
                </div>
            @endforelse
        </div>

        <div class="flex bg-white items-center justify-between rounded-lg px-4 md:px-6 py-2 gap-8">
            <p class="flex items-center gap-2 text[#6F6F6F] text-sm">Total : <span
                    class="text-[#EE4D2D]">₱{{ number_format($this->totalAmount, 2) }}</span>
            </p>
            <a href="{{ count($cartItems) > 0 ? '/checkout' : '/signin' }}"
                class="bg-[#5AA526] py-1 px-4 rounded-lg text-white text-sm font-bold">
                Buy now
            </a>
        </div>
    </div>
</div>
