<div class="flex flex-col gap-4 pb-2">
    @if ($this->totalProduct > 0)
        <div class="w-full overflow-x-auto">
            <div class="min-w-[768px] flex flex-col gap-2">
                <div class="flex items-center text-center font-inter font-medium text-sm text-[#999999]">
                    <div class="w-[35%] text-start pl-4">PRODUCTS</div>
                    <div class="w-[10%]">IN STOCK</div>
                    <div class="w-[10%]">QUANTITY</div>
                    <div class="w-[20%]">UNIT PRICE</div>
                    <div class="w-[20%]">TOTAL AMOUNT</div>
                    <div class="w-[5%]"></div>
                </div>
                <div class="flex flex-col">
                    @foreach ($products as $product)
                        <div class="flex items-center text-center font-inter font-medium text-sm py-3">
                            <div class="w-[35%] text-start pl-4 line-clamp-1">{{ $product->name }}</div>
                            <div class="w-[10%]">{{ $product->stock }}</div>
                            <div class="w-[10%]">
                                <div class="w-full flex items-center justify-center">
                                    <input type="number" wire:model.lazy="products.{{ $loop->index }}.quantity"
                                        class="w-[60%] text-center focus:outline-none border-b" />
                                </div>
                            </div>
                            <div class="w-[20%]">₱{{ number_format($product->price, 2) }}</div>
                            <div class="w-[20%]">₱{{ number_format($product->price * $product->quantity, 2) }}</div>
                            <div class="w-[5%]flex items-center justify-center">
                                <button class="cursor-pointer text-red-500"
                                    wire:click='removeProduct({{ $product->id }})'>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-trash2-icon lucide-trash-2">
                                        <path d="M10 11v6" />
                                        <path d="M14 11v6" />
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                        <path d="M3 6h18" />
                                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <hr class="border-[#BBBBBB] mt-4 mb-2">
        <div class="flex items-center justify-between text-center font-inter text-sm py-3">
            <p class="font-semibold pl-4">Total:</p>
            <p class="w-[19.2%] font-bold">₱{{ number_format($this->totalAmount, 2) }}</p>
        </div>
    @else
        <div class="w-full h-[250px] flex items-center justify-center text-[#797979] font-poppins text-lg">
            No Products Added.
        </div>
    @endif



</div>
