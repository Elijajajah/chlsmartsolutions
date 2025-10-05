<form wire:submit='createTask' class="flex flex-col gap-4">
    <div class="flex items-center gap-8">
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Task Title</p>
            <div class="flex items-center flex-1 relative text-[#797979]">
                <select wire:change="$set('title', $event.target.value)"
                    class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                    name="title" id="title">
                    <option disabled selected>Select a title</option>
                    <option value="technical support">Technical Support</option>
                    <option value="maintenance">Maintenance</option>
                    <option value="installation">Installation</option>
                    <option value="troubleshooting assistance">Troubleshooting Assistance</option>
                    <option value="device resets">Device Resets</option>
                    <option value="usage guidance">Usage Guidance</option>
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
            <p class="text-sm font-medium">Task Priority</p>
            <div class="flex items-center flex-1 relative text-[#797979]">
                <select wire:change="$set('priority', $event.target.value)"
                    class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                    name="priority" id="priority">
                    <option disabled selected>Select a Priority</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
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
            <p class="text-sm font-medium">Expiration Date</p>
            <div class="flex items-center relative text-[#797979]">
                <input wire:input="$set('expiry_date', $event.target.value)" type="date" name="date"
                    id="date"
                    class="hide-calendar w-full pr-10 pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />

                <svg onclick="document.getElementById('date').showPicker()"
                    class="absolute top-2 right-4 cursor-pointer text-gray-600 hover:text-gray-800"
                    xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M8 2v4" />
                    <path d="M16 2v4" />
                    <rect width="18" height="18" x="3" y="4" rx="2" />
                    <path d="M3 10h18" />
                    <path d="m9 16 2 2 4-4" />
                </svg>
            </div>
        </div>
    </div>
    <div class="flex items-center gap-8">
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Assign Technician</p>
            <div class="flex items-center flex-1 relative text-[#797979]">
                <select wire:change="$set('user_id', $event.target.value)"
                    class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                    name="technician" id="technician">
                    <option disabled selected>Select a Technician</option>
                    @foreach ($technicians as $tech)
                        <option value="{{ $tech->id }}">{{ $tech->fullname }}</option>
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
            <p class="text-sm font-medium">Customer Name</p>
            <input wire:input="$set('customer_name', $event.target.value)" type="text" placeholder="Enter Name..."
                name="customer_name" id="customer_name"
                class="w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
        </div>
        <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
            <p class="text-sm font-medium">Customer Contact</p>
            <div class="relative">
                <input wire:input="$set('customer_phone', $event.target.value)" type="text" maxlength="10"
                    inputmode="numeric" placeholder="Enter Phone..." value="9" name="customer_phone"
                    id="customer_phone"
                    class="w-full pl-18 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
                <div class="absolute left-4 top-2.5 border-r border-gray-500 pr-2">+63</div>
            </div>
        </div>
    </div>
    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
        <p class="text-sm font-medium">Customer Request Description (Optional)</p>
        <textarea wire:input="$set('description', $event.target.value)" name="description" id="description" rows="5"
            class="border border-gray-500 focus:outline-none text-[#797979] w-full resize-none py-2 px-4 rounded-md"
            placeholder="Enter description here..."></textarea>
    </div>
    <div class="w-full flex items-center justify-end">
        <button type="submit"
            class="bg-[#16A34A] text-white rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                <path d="M5 12h14" />
                <path d="M12 5v14" />
            </svg>
            <p>Create Task</p>
        </button>
    </div>
</form>
