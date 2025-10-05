<form wire:submit='createExpense' class="flex flex-col gap-3">
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-xs md:text-sm font-medium">Expense Title</p>
        <input wire:input="$set('title', $event.target.value)" type="text" placeholder="e.g. Electric Bill"
            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-xs md:text-sm font-medium">Category</p>
        <div class="text-sm md:text-base flex items-center flex-1 relative text-[#797979]">
            <select wire:change="$set('category', $event.target.value)"
                class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                <option disabled selected>Select a Category</option>
                <option value="monthly dues">Monthly Dues</option>
                <option value="employee salary">Employee Salary</option>
                <option value="supplies & materials">Supplies & Materials</option>
                <option value="miscellaneous">Miscellaneous</option>
                <option value="other expenses">Other Expense</option>
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
        <p class="text-xs md:text-sm font-medium">Amount(₱)</p>
        <input wire:input="$set('amount', $event.target.value)" type="number" placeholder="0.00"
            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-xs md:text-sm font-medium">Date of Expense</p>
        <div class="flex items-center relative text-[#797979]">
            <input wire:input="$set('expense_date', $event.target.value)" type="date" id="date"
                class="text-sm md:text-base hide-calendar w-full pr-10 pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />
            <svg onclick="document.getElementById('date').showPicker()"
                class="absolute top-2 right-4 cursor-pointer text-gray-600 hover:text-gray-800 size-5 md:size-6"
                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M8 2v4" />
                <path d="M16 2v4" />
                <rect width="18" height="18" x="3" y="4" rx="2" />
                <path d="M3 10h18" />
                <path d="m9 16 2 2 4-4" />
            </svg>
        </div>
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-xs md:text-sm font-medium">Notes/Remarks (Optional)</p>
        <textarea wire:input="$set('remarks', $event.target.value)" name="description" id="description" rows="5"
            class="text-sm md:text-base border border-gray-500 focus:outline-none text-[#797979] w-full resize-none py-2 px-4 rounded-md"
            placeholder="Enter Notes/Remarks here..."></textarea>
    </div>

    <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 md:mt-6">
        <button type="button" wire:click='cancel'
            class="w-full flex-1 py-2 border border-[#4f4f4f] rounded-md text-xs md:text-sm cursor-pointer">
            Cancel
        </button>
        <button class="w-full flex-1 py-2 bg-[#203D3F] rounded-md text-xs md:text-sm text-white cursor-pointer" type="submit">
            Save Expense
        </button>
    </div>
</form>
