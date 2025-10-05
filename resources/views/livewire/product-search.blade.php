<div class="flex items-center gap-4">
    <div class="relative">
        <div class="relative text-[#797979]">
            <input type="text" wire:input.debounce.300ms="$set('query', $event.target.value)"
                placeholder="Search product..."
                class="w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </div>
        </div>
        @if (!empty($query) && $results->isNotEmpty())
            <ul class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-md">
                @foreach ($results as $result)
                    <li wire:click="selectProduct({{ $result->id }})"
                        class="px-4 py-2 hover:bg-gray-100 cursor-pointer">
                        {{ $result->name }}
                    </li>
                @endforeach
            </ul>
        @elseif (!empty($query))
            <p
                class="absolute z-10 mt-1 w-full bg-white px-4 py-2 text-sm text-gray-500 border border-gray-300 rounded-md shadow-md">
                No results found.</p>
        @endif

        @if (!empty($selected))
            <div class="mt-2 flex flex-wrap absolute w-full border border-gray-300 rounded-md overflow-hidden">
                @foreach ($selected as $item)
                    <div
                        class="bg-white border border-b border-gray-300 last:border-none px-3 py-1 w-full text-sm text-gray-700 flex justify-between items-center">
                        <p>{{ $item->name }}</p>
                        <button class="cursor-pointer" wire:click='removeProduct({{ $item->id }})'>
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-red-500" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    <button wire:click='addProducts'
        class="bg-[#21C25C] text-white rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-plus-icon lucide-plus">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
        <p class="flex md:gap-1">Add <span class="hidden md:block">Product</span></p>
    </button>
</div>
