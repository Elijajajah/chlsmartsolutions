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
        <button wire:click="exportAllReports"
            class="cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md text-white text-sm gap-2 whitespace-nowrap">
            Download Report
        </button>
    </div>

    <div class="flex flex-col md:flex-row gap-16 md:gap-4 font-poppins">
        <div class="w-full md:w-[69%] flex flex-col gap-4">
            <livewire:dashboard-overview :date="$startDate" :key="'dashboard-overview' . $startDate" />
            <div class="flex flex-col gap-12 md:gap-15">
                <div class="h-[245px]">
                    <livewire:sales-line-chart :date="$startDate" :key="'sales-line-chart' . $startDate" />
                </div>
                <div class="h-[245px]">
                    <livewire:expenses-line-chart :date="$startDate" :key="'expenses-line-chart' . $startDate" />
                </div>
            </div>
        </div>
        <div class="w-full md:w-[29%] flex flex-col gap-4">
            <livewire:order-overview :take="4" />
            <livewire:inventory-overview :take="4" />
            <livewire:expense-overview :take="4" />
        </div>
    </div>
</div>
