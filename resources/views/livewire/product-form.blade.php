<form wire:submit='createProduct' class="rounded-md border border-gray-400 p-4 flex flex-col gap-4 w-full">
    <div class="flex flex-col md:flex-row gap-4 w-full">
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Serial Number</p>
            <input type="text" placeholder="Enter Serial Number..."
                wire:input="$set('serial_number', $event.target.value)"
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Product Name</p>
            <input type="text" placeholder="Enter Name..." wire:input="$set('name', $event.target.value)"
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Category</p>
            <div class="flex items-center flex-1 relative text-[#797979]">
                <select wire:change="$set('categoryId', $event.target.value)"
                    class="text-sm md:text-base w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                    <option disabled selected>Select a Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
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
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Product Price</p>
            <input wire:input="$set('price', $event.target.value)" type="number" step="0.01"
                placeholder="Enter Price..."
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
    </div>
    <div class="flex flex-col md:flex-row gap-4 w-full">
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Current Stock</p>
            <input wire:input="$set('stock', $event.target.value)" type="number" placeholder="Enter Quantity..."
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Minimum Stock</p>
            <input wire:input="$set('stock_min_limit', $event.target.value)" type="number"
                placeholder="Enter Quantity..."
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Maximum Stock</p>
            <input wire:input="$set('stock_max_limit', $event.target.value)" type="number"
                placeholder="Enter Quantity..."
                class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1 w-full">
        <p class="text-sm font-medium">Product Description</p>
        <textarea wire:input="$set('description', $event.target.value)" rows="5"
            class="text-sm md:text-base border border-gray-500 focus:outline-none text-[#797979] w-full resize-none py-2 px-4 rounded-md"
            placeholder="Enter description here..."></textarea>
    </div>
    <div class="flex items-center w-full">
        @if ($image)
            <div class="relative mt-4">
                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                    class="w-40 h-40 object-cover rounded-md shadow border border-gray-300" />
                <button type="button" wire:click="$set('image', null)"
                    class="cursor-pointer absolute top-[-10px] right-[-10px] bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
        @else
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-36 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-7 h-7 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, OR JPG (MAX. 5120kb)</p>
                </div>
                <input id="dropzone-file" type="file" class="hidden" wire:model="image" />
            </label>
        @endif
    </div>
    <div class="w-full flex items-center justify-end">
        <button type="submit"
            class="bg-[#16A34A] text-white rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <p>Create Product</p>
        </button>
    </div>
</form>
