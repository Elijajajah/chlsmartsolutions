<div x-data="{ open: false }" class="relative flex items-center">
    <!-- Button -->
    <button @click="open = true"
        class="relative cursor-pointer w-full flex items-center gap-2 p-2 border-b border-[#DCDCDC]">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"
            stroke-linecap="round" stroke-linejoin="round" class="size-5 lucide lucide-history-icon lucide-history">
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8" />
            <path d="M3 3v5h5" />
            <path d="M12 7v5l4 2" />
        </svg>
        <p class="text-sm">History</p>
    </button>

    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div x-show="open" x-transition @click.outside="open = false"
            class="bg-gray-100 rounded-lg shadow-lg w-[320px] md:w-[500px] max-h-[80vh] p-4 overflow-hidden">
            <div class="flex items-center justify-between">
                <div class="flex flex-col px-2">
                    <h2 class="text-xl md:text-2xl font-bold">Order History</h2>
                    <p class="text-gray-500 text-xs">
                        You have <span class="text-green-600 font-semibold" x-text="cartCount"></span> ordered
                    </p>
                </div>
                <div class="relative text-[#797979]">
                    <select wire:model.live="selectedDate"
                        class="w-[150px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none text-sm">
                        <option value="today">Today</option>
                        <option value="this_week">This Week</option>
                        <option value="this_month">This Month</option>
                        <option selected value="this_year">This Year</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>

            <hr class="my-3 border-gray-300" />
            <div class="max-h-[60vh] overflow-y-auto custom-scrollbar">
                @forelse ($orders as $order)
                    @php
                        $groupedSerials = $order->productSerials->groupBy('product_id');
                        $orderTotal = 0;
                    @endphp

                    <div class="bg-white rounded-lg shadow mb-6 p-4">
                        <div class="flex justify-between items-center">

                            <h3 class="font-semibold text-lg mb-3">Order: {{ $order->reference_id }}</h3>
                            @if ($order->status == 'reserved')
                                <div
                                    class="bg-[#ffeaba] py-2 px-4 w-fit rounded-full text-[#c77a0e] flex gap-1 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="19" cy="12" r="1" />
                                        <circle cx="5" cy="12" r="1" />
                                    </svg>
                                    <p class="text-xs capitalize">{{ $order->status }}</p>
                                </div>
                            @else
                                <div
                                    class="bg-[#c1eacad7] py-2 px-4 w-fit rounded-full text-[#16A34A] flex gap-1 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-check-icon lucide-check">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                    <p class="text-xs capitalize">{{ $order->status }}</p>
                                </div>
                            @endif
                        </div>

                        @foreach ($groupedSerials as $index => $serials)
                            @php
                                $product = $serials->first()->product;
                                $quantity = $serials->count();
                                $itemTotal = $product->retail_price * $quantity;
                                $orderTotal += $itemTotal;
                            @endphp

                            <div
                                class="flex items-center justify-between py-3 {{ $loop->last ? '' : 'border-b border-gray-300' }}">
                                <div class="flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $product->image_url) }}"
                                        class="w-12 h-12 object-cover rounded" />
                                    <div>
                                        <p class="font-semibold text-sm line-clamp-1">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">Quantity: {{ $quantity }}</p>
                                    </div>
                                </div>
                                <div class="text-sm font-semibold">
                                    ₱{{ number_format($itemTotal, 2) }}
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-300">
                            <span class="font-semibold">Total Amount:</span>
                            <span class="font-bold text-green-600">₱{{ number_format($order->total_amount, 2) }}</span>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center text-gray-400 py-6">
                        <svg class="size-8 md:size-9" viewBox="0 0 41 39" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.20135 4.48993C2.42512 3.85137 3.15072 3.50627 3.82201 3.71913L4.34201 3.884C5.41206 4.22325 6.31633 4.50993 7.02741 4.82458C7.78322 5.15905 8.43904 5.57358 8.93633 6.22986C9.43363 6.88617 9.63965 7.60907 9.73421 8.3969C9.7825 8.79923 9.80457 9.25033 9.81465 9.75033H28.1033C31.6139 9.75033 33.3692 9.75033 34.1288 10.846C34.8883 11.9417 34.1967 13.4764 32.8138 16.5457L32.0818 18.1707C31.4361 19.6037 31.1134 20.3202 30.4715 20.7227C29.8297 21.1254 29.0102 21.1254 27.3711 21.1254H10.0848C10.2642 22.0026 10.5471 22.5161 10.9489 22.8983C11.4217 23.3479 12.0855 23.6412 13.339 23.8014C14.6294 23.9665 16.3397 23.9691 18.7918 23.9691H30.7502C31.4578 23.9691 32.0314 24.5147 32.0314 25.1879C32.0314 25.861 31.4578 26.4066 30.7502 26.4066H18.6981C16.3618 26.4066 14.4787 26.4066 12.9976 26.2172C11.4599 26.0205 10.1652 25.5998 9.13694 24.6217C8.10868 23.6437 7.66639 22.4121 7.45967 20.9494C7.26054 19.5405 7.26056 17.7493 7.26059 15.527V11.1853C7.26059 10.0266 7.25866 9.26002 7.18825 8.67338C7.12159 8.11789 7.00516 7.84994 6.85753 7.6551C6.70989 7.46027 6.47947 7.27047 5.94654 7.03465C5.38373 6.7856 4.61977 6.54141 3.46423 6.17504L3.01168 6.03153C2.34039 5.81869 1.97759 5.12849 2.20135 4.48993ZM13.6668 13.4066C12.9592 13.4066 12.3856 13.9522 12.3856 14.6253C12.3856 15.2984 12.9592 15.8441 13.6668 15.8441H18.7918C19.4994 15.8441 20.0731 15.2984 20.0731 14.6253C20.0731 13.9522 19.4994 13.4066 18.7918 13.4066H13.6668Z"
                                fill="currentColor" />
                            <path
                                d="M12.8125 29.25C14.2277 29.25 15.375 30.3413 15.375 31.6875C15.375 33.0336 14.2277 34.125 12.8125 34.125C11.3973 34.125 10.25 33.0336 10.25 31.6875C10.25 30.3413 11.3973 29.25 12.8125 29.25Z"
                                fill="currentColor" />
                            <path
                                d="M28.1875 29.25C29.6027 29.25 30.75 30.3412 30.75 31.6875C30.75 33.0336 29.6027 34.125 28.1875 34.125C26.7723 34.125 25.625 33.0336 25.625 31.6875C25.625 30.3412 26.7723 29.25 28.1875 29.25Z"
                                fill="currentColor" />
                        </svg>
                        <p class="mt-2 text-sm">No recent orders</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
