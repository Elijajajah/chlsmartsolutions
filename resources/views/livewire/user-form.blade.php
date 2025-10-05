<form wire:submit='createStaff' class="flex flex-col p-2 gap-2 rounded-md text-sm">
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Fullname</p>
        <input wire:input="$set('fullname', $event.target.value)" type="text" placeholder="Enter name..."
            class="w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Username</p>
        <input wire:input="$set('username', $event.target.value)" type="text" placeholder="Enter username..."
            class="w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Contact</p>
        <div class="relative">
            <input wire:input="$set('phone_number', $event.target.value)" type="text" maxlength="10"
                inputmode="numeric" placeholder="Enter phone..." value="9"
                class="w-full pl-18 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
            <div class="absolute left-4 top-2.5 border-r border-gray-500 pr-2">+63</div>
        </div>
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Password</p>
        <input wire:input="$set('password', $event.target.value)" type="password" placeholder="Enter password..."
            class="w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Role</p>
        <div class="flex items-center flex-1 relative text-[#797979]">
            <select wire:change="$set('role', $event.target.value)"
                class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                <option disabled selected>Select Role</option>
                <option value="admin_officer">Admin Officer</option>
                <option value="cashier">Cashier</option>
                <option value="technician-main">Technician - Main</option>
                <option value="technician-support">Technician - Support</option>
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
    <div class="flex flex-col md:flex-row items-center justify-end w-full gap-2 md:gap-4 mt-4 md:mt-6 text-sm">
        <button wire:click='cancel' type="button"
            class="w-full md:w-auto cursor-pointer flex gap-2 items-center justify-center py-2 px-4 bg-[#F2F2F2] rounded-md">
            Cancel
        </button>
        <button class="w-full md:w-auto cursor-pointer flex gap-2 items-center justify-center py-2 px-4 bg-[#203D3F] rounded-md text-white"
            type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <p>Create User</p>
        </button>
    </div>
</form>
