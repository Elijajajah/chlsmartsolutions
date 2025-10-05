<div class="flex flex-col gap-4">
    <div class="w-full flex items-center justify-end gap-4">
        <div class="relative text-[#797979]">
            <select wire:change="$set('selectedDate', $event.target.value)"
                class="w-[150px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none text-sm">
                <option value="today">Today</option>
                <option value="this_week">This Week</option>
                <option value="this_month">This Month</option>
                <option selected value="this_year">This Year</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </div>
        </div>
        <button class="cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md text-white text-sm gap-2 whitespace-nowrap">
            Download Report
        </button>
    </div>
    <div class="flex flex-col md:flex-row gap-4 font-poppins">
        <div class="w-full md:w-[69%] flex flex-col gap-4">
            <div class="w-full flex flex-wrap md:flex-nowrap gap-2 md:gap-3 justify-center md:justify-between">
                <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
                    <div class="rounded-full bg-[#FF7555] text-white flex justify-center items-center size-13">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-file-text-icon lucide-file-text">
                            <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                            <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                            <path d="M10 9H8" />
                            <path d="M16 13H8" />
                            <path d="M16 17H8" />
                        </svg>
                    </div>
                    <p class="font-medium text-xs mt-3">Total Expenses</p>
                    <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All-time expenses</p>
                    <h1 class="text-[#FF7555] font-semibold mt-6">₱{{ number_format($this->totalExpenses, 2) }}</h1>
                </div>
                <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
                    <div class="rounded-full bg-[#39A1EA] text-white flex justify-center items-center size-13">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-shopping-basket-icon lucide-shopping-basket">
                            <path d="m15 11-1 9" />
                            <path d="m19 11-4-7" />
                            <path d="M2 11h20" />
                            <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8a2 2 0 0 0 2-1.6l1.7-7.4" />
                            <path d="M4.5 15.5h15" />
                            <path d="m5 11 4-7" />
                            <path d="m9 11 1 9" />
                        </svg>
                    </div>
                    <p class="font-medium text-xs mt-3">Sales Today</p>
                    <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">Sales made today</p>
                    <h1 class="text-[#39A1EA] font-semibold mt-6">₱{{ number_format($this->salesToday, 2) }}</h1>
                </div>
                <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
                    <div class="rounded-full bg-[#405089] text-white flex justify-center items-center size-13">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-calendar-range-icon lucide-calendar-range">
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M16 2v4" />
                            <path d="M3 10h18" />
                            <path d="M8 2v4" />
                            <path d="M17 14h-6" />
                            <path d="M13 18H7" />
                            <path d="M7 14h.01" />
                            <path d="M17 18h.01" />
                        </svg>
                    </div>
                    <p class="font-medium text-xs mt-3">Order Today</p>
                    <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">Available orders</p>
                    <h1 class="text-[#405089] font-semibold mt-6">{{ $this->orderToday }}</h1>
                </div>
                <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
                    <div class="rounded-full bg-[#FEB558] text-white flex justify-center items-center size-13">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-clipboard-list-icon lucide-clipboard-list">
                            <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                            <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                            <path d="M12 11h4" />
                            <path d="M12 16h4" />
                            <path d="M8 11h.01" />
                            <path d="M8 16h.01" />
                        </svg>
                    </div>
                    <p class="font-medium text-xs mt-3">Task Today</p>
                    <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">Pending tasks</p>
                    <h1 class="text-[#FEB558] font-semibold mt-6">{{ $this->taskToday }}</h1>
                </div>
                <div class="hidden md:w-1/5 md:flex flex-col items-center justify-center bg-white p-4 rounded-lg">
                    <div class="rounded-full bg-[#29AB91] text-white flex justify-center items-center size-13">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-package-icon lucide-package">
                            <path
                                d="M11 21.73a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73z" />
                            <path d="M12 22V12" />
                            <polyline points="3.29 7 12 12 20.71 7" />
                            <path d="m7.5 4.27 9 5.15" />
                        </svg>
                    </div>
                    <p class="font-medium text-xs mt-3">Total Products</p>
                    <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All available items</p>
                    <h1 class="text-[#29AB91] font-semibold mt-6">{{ $this->totalProduct }}</h1>
                </div>
            </div>
            <div class="h-[275px] md:h-[375px]">
                <livewire:sales-line-chart :date="$startDate" :key="'sales-line-chart' . $startDate" />
            </div>
        </div>
        <div class="w-full md:w-[29%] flex flex-col gap-4 mt-8 mb-4 md:mb-0 md:mt-0">
            <livewire:order-overview />
            <livewire:inventory-overview />
            <livewire:task-overview />
        </div>
    </div>
</div>