<form wire:submit="createTask" class="flex flex-col gap-3 w-full">
    <!-- Services -->
    <div class="relative w-full">
        <select wire:model.live="title"
            class="w-full px-4 py-3 text-[#797979] bg-gray-100 border border-gray-300 rounded-md appearance-none focus:outline-none">
            <option disabled value="">Services</option>
            <option value="technical support">Technical Support</option>
            <option value="maintenance">Maintenance</option>
            <option value="installation">Installation</option>
            <option value="troubleshooting assistance">Troubleshooting Assistance</option>
            <option value="device resets">Device Resets</option>
            <option value="usage guidance">Usage Guidance</option>
        </select>
        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
            <svg class="w-5 h-5 text-[#797979]" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    <!-- Contact & Priority -->
    <div class="flex flex-col md:flex-row gap-4 w-full">
        <!-- Contact (readonly since from user) -->
        <div class="relative w-full md:w-2/3">
            <input type="text" value="{{ Auth::user()->phone_number ?? '9' }}" maxlength="10" inputmode="numeric"
                class="w-full pl-16 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none" />
            <div class="absolute left-4 top-1/2 -translate-y-1/2 border-r border-gray-500 pr-2 text-gray-700">
                +63
            </div>
        </div>

        <!-- Priority dropdown -->
        <div class="relative w-full md:w-1/3">
            <select wire:model.live="priority"
                class="w-full px-4 py-3 text-[#797979] bg-gray-100 border border-gray-300 rounded-md appearance-none focus:outline-none">
                <option disabled value="">Priority</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                <svg class="w-5 h-5 text-[#797979]" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Description -->
    <textarea wire:model="description" rows="5" placeholder="Enter your question or message"
        class="px-4 py-3 border border-gray-300 bg-gray-100 rounded-md resize-none focus:outline-none"></textarea>

    <button type="submit"
        class="cursor-pointer mt-4 bg-[#5AA526] hover:bg-[#48841b] text-white font-semibold py-3 px-6 rounded-md transition">
        Send Message
    </button>
</form>
