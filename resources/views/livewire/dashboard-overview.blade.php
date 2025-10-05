<div class="w-full flex flex-wrap md:flex-nowrap gap-2 md:gap-3 justify-center md:justify-between">
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#FF7555] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-trending-up-icon lucide-trending-up">
                <path d="M16 7h6v6" />
                <path d="m22 7-8.5 8.5-5-5L2 17" />
            </svg>
        </div>
        <p class="font-medium text-xs mt-3">Total Sales</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All-time revenue</p>
        <h1 class="text-[#FF7555] font-semibold mt-6">₱{{ number_format($this->totalRevenue, 2) }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#39A1EA] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-file-text-icon lucide-file-text">
                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                <path d="M10 9H8" />
                <path d="M16 13H8" />
                <path d="M16 17H8" />
            </svg>
        </div>
        <p class="font-medium text-xs mt-3">Total Expenses</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All-time expenses</p>
        <h1 class="text-[#39A1EA] font-semibold mt-6">₱{{ number_format($this->totalExpenses, 2) }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#405089] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-calendar-range-icon lucide-calendar-range">
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
        <p class="font-medium text-xs mt-3">Total Order</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">Completed orders</p>
        <h1 class="text-[#405089] font-semibold mt-6">{{ $this->order }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#FEB558] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-circle-user-round-icon lucide-circle-user-round">
                <path d="M18 20a6 6 0 0 0-12 0" />
                <circle cx="12" cy="10" r="4" />
                <circle cx="12" cy="12" r="10" />
            </svg>
        </div>
        <p class="font-medium text-xs mt-3">Total Staff</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">Active employees</p>
        <h1 class="text-[#FEB558] font-semibold mt-6">{{ $this->staff }}</h1>
    </div>
    <div class="hidden md:w-1/5 md:flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#29AB91] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-package-icon lucide-package">
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
