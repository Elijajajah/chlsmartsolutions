<div class="w-full bg-white rounded-lg flex flex-col p-4">
    <h1 class="text-[#203D3F] font-semibold">Inventory Overview</h1>
    <p class="text-[0.6rem] text-[#BDBEC3] mb-2">Track products needing restock</p>
    <div class="flex flex-col gap-2">
        @forelse ($products as $product)
            @if ($product->inventory->stock == 0)
                <div class="flex items-center justify-between p-2 text-sm rounded-sm w-full border-2 border-[#DC2626]">
                    <p class="line-clamp-1 capitalizee w-[70%]">{{ $product->name }}</p>
                    <p class="text-[#DC2626] font-medium">{{ $product->inventory->stock }}<span
                            class="font-normal text-[0.6rem]">left</span></p>
                </div>
            @else
                <div class="flex items-center justify-between p-2 text-sm rounded-sm w-full border-2 border-[#EAB308]">
                    <p class="line-clamp-1 capitalize w-[70%]">{{ $product->name }}</p>
                    <p class="text-[#EAB308] font-medium">{{ $product->inventory->stock }}<span
                            class="font-normal text-[0.6rem]">left</span></p>
                </div>
            @endif
        @empty
            <div class="flex flex-col items-center justify-around pt-8 pb-7.5 text-[#BDBEC3] gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-package-open-icon lucide-package-open">
                    <path d="M12 22v-9" />
                    <path
                        d="M15.17 2.21a1.67 1.67 0 0 1 1.63 0L21 4.57a1.93 1.93 0 0 1 0 3.36L8.82 14.79a1.655 1.655 0 0 1-1.64 0L3 12.43a1.93 1.93 0 0 1 0-3.36z" />
                    <path
                        d="M20 13v3.87a2.06 2.06 0 0 1-1.11 1.83l-6 3.08a1.93 1.93 0 0 1-1.78 0l-6-3.08A2.06 2.06 0 0 1 4 16.87V13" />
                    <path
                        d="M21 12.43a1.93 1.93 0 0 0 0-3.36L8.83 2.2a1.64 1.64 0 0 0-1.63 0L3 4.57a1.93 1.93 0 0 0 0 3.36l12.18 6.86a1.636 1.636 0 0 0 1.63 0z" />
                </svg>
                <p class="text-xs mt-1">No Products to Restock</p>
            </div>
        @endforelse
    </div>
    @if ($products->count() >= $take)
        <div wire:click="setActive('product')" class="flex py-2 text-sm cursor-pointer">
            <p class="text-[#203D3F] font-medium">See more...</p>
        </div>
    @endif
</div>
