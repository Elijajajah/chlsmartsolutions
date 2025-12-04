<div class="flex flex-col pb-2">
    <div class="w-full overflow-x-auto">
        <div class="min-w-[650px] flex flex-col gap-2">
            <!-- Table Header -->
            <div
                class="flex items-center text-center font-inter font-medium text-sm text-[#999999] border-b border-[#DCDCDC] py-2">
                <div class="w-[30%] text-start pl-4">PRODUCTS</div>
                <div class="w-[25%]">QUANTITY</div>
                <div class="w-[20%]">UNIT PRICE</div>
                <div class="w-[20%]">TOTAL AMOUNT</div>
                <div class="w-[5%]"></div>
            </div>

            <!-- Table Body -->
            <div class="flex flex-col h-[320px] overflow-y-auto">
                <div class="flex flex-col max-h-[400px] overflow-y-auto">
                    @forelse ($products as $index => $product)
                        @php
                            $quantity = isset($product->serials) ? count($product->serials) : $product->quantity ?? 1;
                        @endphp
                        <div
                            class="flex items-center text-center font-inter font-medium text-sm py-3 border-b border-[#EFEFEF] last:border-none">

                            <!-- Product Name -->
                            <div class="w-[30%] text-start pl-4 line-clamp-1">{{ ucwords($product->name) }}</div>

                            <!-- Quantity with Increase/Decrease Buttons -->
                            <div class="w-[25%] flex items-center justify-center gap-2">
                                <button type="button"
                                    class="w-6 h-6 border border-gray-400 rounded flex items-center justify-center cursor-pointer hover:bg-gray-100"
                                    wire:click="decreaseQuantity({{ $index }})">-</button>

                                <span class="font-medium text-center">{{ $quantity }}</span>

                                <button type="button"
                                    class="w-6 h-6 border border-gray-400 rounded flex items-center justify-center cursor-pointer hover:bg-gray-100"
                                    wire:click="increaseQuantity({{ $index }})">+</button>
                            </div>

                            <!-- Unit Price -->
                            <div class="w-[20%]">₱{{ number_format($product->price, 2) }}</div>

                            <!-- Total Amount -->
                            <div class="w-[20%]">₱{{ number_format($product->price * $quantity, 2) }}</div>

                            <!-- Remove Button -->
                            <div class="w-[5%] flex items-center justify-center">
                                <button class="cursor-pointer text-red-500"
                                    wire:click="removeProduct({{ $product->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M10 11v6" />
                                        <path d="M14 11v6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                        <path d="M3 6h18" />
                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div
                            class="w-full h-[200px] flex items-center justify-center text-[#797979] font-poppins text-sm">
                            No products added.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <hr class="border-[#BBBBBB] mt-4 mb-2">
    @if ($tax > 0)
        <div class="flex items-center justify-between text-center font-inter text-sm py-3">
            <p class="font-semibold pl-4">Total:</p>
            <p class="w-[19.2%] font-bold">{{ $tax }}%</p>
        </div>
    @endif
    <div class="flex items-center justify-between text-center font-inter text-sm py-3">
        <p class="font-semibold pl-4">Total:</p>
        <p class="w-[19.2%] font-bold">₱{{ number_format($this->totalAmount, 2) }}</p>
    </div>

    <div class="flex flex-col gap-2 md:items-start font-inter md:gap-6">
        <h1 class="font-poppins font-medium">Customer Details</h1>
        <div class="flex items-center gap-4 w-full">
            <div class="flex flex-col text-[#4f4f4f] gap-1 w-full md:w-fit">
                <p class="text-sm font-medium">Customer Name</p>
                <input type="text" placeholder="Enter Name..." wire:model.live="customer_name" id="customer_name"
                    name="customer_name"
                    class="text-sm w-full md:w-[200px] pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
            </div>
            <div class="flex flex-col text-[#797979] gap-1">
                <p class="text-sm font-medium">Customer Type</p>
                <div class="relative">
                    <select wire:model.live="type"
                        class="text-sm w-full md:w-[200px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                        name="type" id="type">
                        <option value="" disabled>Select a type</option>
                        <option value="walk_in">Walk-in</option>
                        <option value="project_based">Project-based</option>
                        <option value="government">Government</option>
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
        </div>
        <div class="flex items-end gap-4 w-full">
            <div class="flex flex-col text-[#797979] gap-1">
                <p class="text-sm font-medium">Payment Method</p>
                <div class="relative text-[#797979] mr-auto">
                    <select wire:model.live="payment_method"
                        class="w-[200px] text-sm px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                        name="status" id="status">
                        <option value="none">Payment Method</option>
                        <option value="cheque">Cheque</option>
                        <option value="home_credit">Home-credit</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="ewallet">E-Wallet</option>
                        <option value="cash">Cash</option>
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
            @if ($type === 'government')
                <div class="flex flex-col text-[#4f4f4f] gap-1 w-full md:w-fit">
                    <p class="text-sm font-medium">Tax</p>
                    <div class="relative w-full md:w-[200px]">
                        <input type="number" placeholder="Enter Tax..." wire:model.live="tax" id="tax"
                            name="tax"
                            class="text-sm w-full pl-4 pr-8 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />

                        <span class="absolute inset-y-0 right-3 flex items-center text-[#797979] pointer-events-none">
                            %
                        </span>
                    </div>
                </div>
            @endif
            <div class="w-full flex justify-end">
                @csrf

                <input type="hidden" name="customer_name" value="{{ $customer_name }}">
                <input type="hidden" name="type" value="{{ $type }}">
                <input type="hidden" name="payment_method" value="{{ $payment_method }}">
                <input type="hidden" name="tax" value="{{ $tax }}">
                <input type="hidden" name="total_amount" value="{{ $this->totalAmount }}">

                <button type="submit" wire:click="submit"
                    class="bg-[#2563EB] text-white rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M20 6 9 17l-5-5" />
                    </svg>
                    <p>Create Order</p>
                </button>
            </div>

        </div>
    </div>
</div>
