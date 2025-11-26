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
        <p class="font-medium text-xs mt-3">Total Net Income</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All-time Net Income</p>
        <h1 class="text-[#FF7555] font-semibold mt-6">
            ₱{{ number_format($this->totalSales - $this->totalExpenses, 2) }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#39A1EA] text-white flex justify-center items-center size-13">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-hand-coins-icon lucide-hand-coins">
                <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                <path d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                <path d="m2 16 6 6" />
                <circle cx="16" cy="9" r="2.9" />
                <circle cx="6" cy="5" r="3" />
            </svg>
        </div>
        <p class="font-medium text-xs mt-3">Total Sales</p>
        <p class="text-[#BDBEC3] font-lighter text-[0.6rem]">All-time sales</p>
        <h1 class="text-[#39A1EA] font-semibold mt-6">₱{{ number_format($this->totalSales, 2) }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#405089] text-white flex justify-center items-center size-13">
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
        <h1 class="text-[#405089] font-semibold mt-6">₱{{ number_format($this->totalExpenses, 2) }}</h1>
    </div>
    <div class="w-[48%] md:w-1/5 flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#FEB558] text-white flex justify-center items-center size-13">
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
        <h1 class="text-[#FEB558] font-semibold mt-6">{{ $this->order }}</h1>
    </div>
    <div class="hidden md:w-1/5 md:flex flex-col items-center justify-center bg-white p-4 rounded-lg">
        <div class="rounded-full bg-[#29AB91] text-white flex justify-center items-center size-13">
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
        <h1 class="text-[#29AB91] font-semibold mt-6">{{ $this->staff }}</h1>
    </div>
</div>
