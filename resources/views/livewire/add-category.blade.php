<div class="flex items-center gap-4 w-full">
    <div class="relative w-full text-[#797979]">

        <input wire:input.debounce.300ms="$set('name', $event.target.value)" type="text" placeholder="Category Name..."
            class="text-sm md:text-base w-full pr-[100px] pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />

        <button wire:click='createCategory'
            class="cursor-pointer absolute right-1 top-1 bottom-1 px-4 bg-[#203D3F] rounded-md flex items-center text-white gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <p class="text-sm">Add</p>
        </button>
    </div>
</div>
