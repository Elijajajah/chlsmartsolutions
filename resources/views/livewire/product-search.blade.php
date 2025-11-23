<div class="flex flex-col items-center gap-2">
    <div class="flex items-center ml-auto gap-4">
        <div class="relative">
            <input type="text" wire:model.live="query" placeholder="Search product..."
                class="w-full pr-10 pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />

            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                    stroke-width="1.5" class="lucide lucide-search">
                    <path d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
    </div>

    <div class="w-full overflow-x-auto">
        <div class="min-w-[350px] flex flex-col font-inter">

            <!-- Table Header -->
            <div class="rounded-t-lg text-sm bg-[#EEF2F5] w-full flex items-center text-center p-3">
                <div class="w-[60%] text-start pl-3">Product</div>
                <div class="w-[20%]">Stock</div>
                <div class="w-[20%]">Actions</div>
            </div>

            <!-- Table Body -->
            <div class="w-full flex flex-col bg-white">

                @forelse ($products as $product)
                    <div class="flex items-center border-b border-[#DCDCDC] last:border-none py-4">

                        <!-- Image + Name + Category -->
                        <div class="w-[78%] md:w-[55%] font-poppins">
                            <div class="flex items-center gap-3">

                                <!-- Product Image -->
                                <img class="block h-12 w-12 object-cover rounded-md"
                                    src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}">

                                <div class="flex flex-col items-start">
                                    <!-- Product Name -->
                                    <h1 class="text-xs md:text-sm font-semibold line-clamp-1">
                                        {{ ucwords($product->name) }}
                                    </h1>

                                    <!-- Category -->
                                    <p class="font-light text-[0.6rem] capitalize text-[#6a6a6a] line-clamp-1">
                                        {{ $product->category->name ?? 'No Category' }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        <!-- Available Stock -->
                        <div class="w-[22%] md:w-[22.5%] text-center font-inter font-medium text-xs md:text-sm">
                            {{ $product->availableCount() }}
                        </div>

                        <!-- Add Button -->
                        <div class="hidden md:flex md:w-[22.5%] justify-center">
                            <button wire:click="selectProduct({{ $product->id }})"
                                class="cursor-pointer w-8 h-8 flex items-center justify-center bg-green-600 text-white rounded-full hover:bg-green-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus-icon">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                            </button>
                        </div>


                    </div>
                @empty
                    <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                        No Products Found.
                    </div>
                @endforelse

            </div>


        </div>
    </div>
    <!-- Pagination -->
    <nav>
        <div class="flex items-center -space-x-px h-8">

            <!-- Previous Button -->
            <button wire:click="previousPage" wire:loading.attr="disabled"
                @if ($products->onFirstPage()) disabled @endif
                class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer
                flex items-center justify-center px-3 h-8 leading-tight bg-white border border-e-0
                border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">

                <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
            </button>

            <!-- Numbered Pages -->
            @foreach (range(1, $products->lastPage()) as $page)
                <button wire:click="gotoPage({{ $page }})"
                    class="flex items-center justify-center px-3 h-8 leading-tight
                    {{ $products->currentPage() === $page
                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                    {{ $page }}
                </button>
            @endforeach

            <!-- Next Button -->
            <button wire:click="nextPage" wire:loading.attr="disabled" @if (!$products->hasMorePages()) disabled @endif
                class="flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer
                px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg
                hover:bg-gray-100 hover:text-gray-700">

                <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
            </button>

        </div>
    </nav>

</div>
