<div class="px-6 md:px-36 flex flex-col py-10 gap-8 pb-10 md:pb-16">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 md:px-6">
        <div class="flex flex-col md:flex-row md:items-center gap-6 w-full md:w-auto">
            <div class="relative w-full md:w-[300px]">
                <input type="text" wire:input.debounce.300ms="$set('search', $event.target.value)"
                    placeholder="Search products..."
                    class="w-full pr-10 pl-4 py-2 text-[#797979] border border-gray-500 rounded-md focus:outline-none" />

                <div class="absolute inset-y-0 right-0 flex items-center text-[#797979] pr-3 pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
            </div>

            <div class="relative w-full md:w-[280px]">
                <select wire:change="$set('selectedCategory', $event.target.value)"
                    class="w-full px-4 py-2 text-[#797979] border border-gray-500 rounded-md focus:outline-none appearance-none">
                    <option value="0">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-3 flex items-center">
                    <svg class="w-6 h-6 text-[#797979]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <h2 class="text-lg text-gray-700">{{ $products->total() }} products found</h2>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 gap-6">
        @forelse ($products as $product)
            <button wire:click="selectProduct({{ $product->id }})" class="cursor-pointer">
                <div class="bg-gray-50 rounded-lg shadow p-4 flex flex-col items-center text-center">
                    <div class="relative w-full">
                        <div
                            class="absolute top-[-6px] md:top-0 right-[-4px] md:right-0 bg-transparent text-[#5AA526] font-semibold text-xs md:text-sm px-2 py-1">
                            ₱{{ number_format($product->price, 2) }}
                        </div>

                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="Product Image"
                            class="h-32 md:h-48 object-contain w-full" />
                    </div>

                    <h3 class="line-clamp-1 font-medium text-gray-800 mb-2 text-xs md:text-sm">{{ $product->name }}</h3>

                    <div class="text-[8px] md:text-xs bg-[#5AA526] text-white px-2 py-1 rounded-full">
                        {{ $product->category->name }}
                    </div>
                </div>
            </button>
        @empty
            <div class="col-span-full text-center text-gray-500 py-16 md:py-28">
                No products found.
            </div>
        @endforelse
    </div>

    @if ($showModal && $selectedProduct)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div class="bg-white rounded-xl shadow-lg max-w-[280px] md:max-w-2xl w-full p-8 relative font-inter">
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6">
                    <div class="flex items-center md:w-[35%]">
                        <img src="{{ asset('storage/' . $selectedProduct->image_url) }}"
                            class="w-36 h-36 md:w-full md:h-auto object-contain" />
                    </div>

                    <div class="md:w-[65%] flex flex-col">
                        <h2 class="text-[0.6rem] md:text-xs text-gray-500">{{ $selectedProduct->category->name }}</h2>
                        <h1 class="text-sm md:text-xl font-bold">{{ $selectedProduct->name }}</h1>
                        <div class="flex items-center justify-between">
                            <p class="text-green-700 font-semibold text-sm md:text-lg">
                                ₱{{ number_format($selectedProduct->price, 2) }}</p>
                            <p class="text-[0.6rem] md:text-xs text-gray-600">Current Stock:
                                {{ $selectedProduct->inventory->stock }}</p>
                        </div>
                        <p
                            class="text-[0.6rem] md:text-xs text-gray-700 my-4 max-h-16 overflow-hidden overflow-y-auto custom-scrollbar">
                            {{ $selectedProduct->description }}
                        </p>

                        <div class="flex flex-col w-full gap-3">
                            <button wire:click="closeModal"
                                class="bg-gray-200 cursor-pointer px-4 py-2 rounded-lg hover:bg-[#F6F6F8] text-sm text-[#848484] w-full">
                                Continue Shopping
                            </button>
                            <button wire:click="addToCart"
                                class="bg-[#5AA526] cursor-pointer text-white px-4 py-2 rounded-lg hover:bg-green-600 text-sm w-full">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <div class="flex justify-center pt-4">
        <div class="inline-flex items-center space-x-2">
            <button wire:click="previousPage" wire:loading.attr="disabled"
                @if ($products->onFirstPage()) disabled @endif
                class="text-gray-700 pr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                <svg width="14" height="18" viewBox="0 0 11 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.561 14.7161L0.717773 7.37025L10.561 0.0244141V14.7161Z" fill="#1D1B20" />
                </svg>
            </button>

            @foreach (range(1, $products->lastPage()) as $page)
                <button wire:click="gotoPage({{ $page }})"
                    class="px-4 py-2 shadow-md rounded-xl font-medium
                       {{ $products->currentPage() === $page ? 'bg-[#5AA526] text-white' : 'bg-white hover:bg-gray-100 text-gray-700 cursor-pointer' }}">
                    {{ $page }}
                </button>
            @endforeach

            <button wire:click="nextPage" wire:loading.attr="disabled" @if (!$products->hasMorePages()) disabled @endif
                class="text-gray-700 pl-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                <svg width="14" height="18" viewBox="0 0 11 15" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M0.439453 14.7161V0.0244141L10.2826 7.37025L0.439453 14.7161Z" fill="#1D1B20" />
                </svg>
            </button>
        </div>
    </div>
</div>
