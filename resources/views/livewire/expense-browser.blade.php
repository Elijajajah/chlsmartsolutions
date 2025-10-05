<div class="flex flex-col gap-4 md:gap-6 relative pb-4 md:pb-0">
    <button wire:click='openModal'
        class="fixed bottom-6 right-6 z-20 bg-[#203D3F] hover:bg-[#182f31] text-white rounded-full shadow-lg p-3 flex items-center justify-center transition-colors duration-200"
                style="box-shadow: 0 4px 16px rgba(32,61,63,0.15);">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>  
    </button>
    <div class="w-full flex items-center justify-end gap-4">
        <div class="hidden w-full md:flex items-center justify-end">
            <button wire:click='openModal'
                class="bg-[#16A34A] text-white text-sm rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                <p>Add New Expense</p>
            </button>
        </div>
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
        <button wire:click="exportExpenses"
            class="cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md text-white text-sm gap-2 whitespace-nowrap">
            Download Report
        </button>
    </div>
    <div class="flex flex-col md:flex-row items-center font-poppins gap-4">
        <div
            class="w-full h-18 md:flex-1 flex items-center justify-between rounded-lg pl-4 px-6 gap-4 py-4 text-white bg-gradient-to-r from-[#1859FF] to-[#799EFD]">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="size-10 lucide lucide-file-text-icon lucide-file-text">
                    <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                    <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                    <path d="M10 9H8" />
                    <path d="M16 13H8" />
                    <path d="M16 17H8" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-xs">Total</p>
                    <p class="font-medium">Expenses</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-bold">₱{{ number_format($this->expense->sum('amount'), 2) }}</h1>
        </div>
        <div
            class="w-full h-18 md:flex-1 flex items-center justify-between rounded-lg pl-4 px-6 gap-4 py-4 text-white bg-gradient-to-r from-[#FF0404] to-[#ff8181]">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="size-10 lucide lucide-scroll-text-icon lucide-scroll-text">
                    <path d="M15 12h-5" />
                    <path d="M15 8h-5" />
                    <path d="M19 17V5a2 2 0 0 0-2-2H4" />
                    <path
                        d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-xs">Total</p>
                    <p class="font-medium">Entries</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-bold">{{ count($this->expense) }}</h1>
        </div>
        <div
            class="w-full h-18 md:flex-1 flex items-center justify-between rounded-lg pl-4 px-6 gap-4 py-4 text-white bg-gradient-to-r from-[#21C25C] to-[#27e16b]">
            <div class="flex items-center gap-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="size-10 lucide lucide-coins-icon lucide-coins">
                    <circle cx="8" cy="8" r="6" />
                    <path d="M18.09 10.37A6 6 0 1 1 10.34 18" />
                    <path d="M7 6h1v4" />
                    <path d="m16.71 13.88.7.71-2.82 2.82" />
                </svg>
                <div class="flex flex-col">
                    @php
                        $title = match ($selectedDate) {
                            'today' => 'Today',
                            'this_week' => 'This Week',
                            'this_month' => 'This Month',
                            'this_year' => 'This Year',
                        };
                    @endphp
                    <p class="text-xs">{{ $title }}</p>
                    <p class="font-medium">Expenses</p>
                </div>
            </div>
            <div class="flex flex-col items-end">
                <h1 class="ml-4 text-2xl font-bold">₱{{ number_format($data->sum('amount'), 2) }}</h1>
                <p class="text-[0.7rem] -mt-1">{{ $data->count() }} Entries</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:items-center w-full gap-4 font-poppins">
        <h1 class="text-[#203D3F] text-lg font-semibold text-start w-full">Expenses Category</h1>
        <div class="flex items-center gap-5 overflow-hidden overflow-x-auto md:w-[65rem] pb-4">
            <button wire:click="$set('category', 'monthly dues')"
                class="min-w-63 shrink-0 flex flex-col bg-white rounded-lg p-6 gap-3 cursor-pointer {{ $category === 'monthly dues' ? 'border-4 border-[#3C7AFF]' : '' }}">
                <div class="flex items-center justify-between gap-10">
                    <div class="rounded bg-[#3C7AFF] text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="size-6 lucide lucide-calendar-days-icon lucide-calendar-days">
                            <path d="M8 2v4" />
                            <path d="M16 2v4" />
                            <rect width="18" height="18" x="3" y="4" rx="2" />
                            <path d="M3 10h18" />
                            <path d="M8 14h.01" />
                            <path d="M12 14h.01" />
                            <path d="M16 14h.01" />
                            <path d="M8 18h.01" />
                            <path d="M12 18h.01" />
                            <path d="M16 18h.01" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-end">
                        <h1 class="font-bold text-lg">
                            ₱{{ number_format($data->where('category', 'monthly dues')->sum('amount'), 2) }}</h1>
                        <p class="text-xs text-[#989898]">{{ $data->where('category', 'monthly dues')->count() }}
                            Expenses</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium">Monthly Dues</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-[#989898] lucide lucide-chevron-right-icon lucide-chevron-right {{ $category === 'monthly dues' ? 'rotate-90' : '' }}">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </div>
            </button>
            <button wire:click="$set('category', 'employee salary')"
                class="min-w-63 shrink-0 flex flex-col bg-white rounded-lg p-6 gap-3 cursor-pointer {{ $category === 'employee salary' ? 'border-4 border-[#FF0404]' : '' }}">
                <div class="flex items-center justify-between gap-10">
                    <div class="rounded bg-[#FF0404] text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="size-6 lucide lucide-square-user-icon lucide-square-user">
                            <rect width="18" height="18" x="3" y="3" rx="2" />
                            <circle cx="12" cy="10" r="3" />
                            <path d="M7 21v-2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-end">
                        <h1 class="font-bold text-lg">
                            ₱{{ number_format($data->where('category', 'employee salary')->sum('amount'), 2) }}</h1>
                        <p class="text-xs text-[#989898]">{{ $data->where('category', 'employee salary')->count() }}
                            Expenses</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium">Employee Salary</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-[#989898] lucide lucide-chevron-right-icon lucide-chevron-right {{ $category === 'employee salary' ? 'rotate-90' : '' }}">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </div>
            </button>
            <button wire:click="$set('category', 'supplies & materials')"
                class="min-w-63 shrink-0 flex flex-col bg-white rounded-lg p-6 gap-3 cursor-pointer {{ $category === 'supplies & materials' ? 'border-4 border-[#21C25C]' : '' }}">
                <div class="flex items-center justify-between gap-10">
                    <div class="rounded bg-[#21C25C] text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="size-6 lucide lucide-package-plus-icon lucide-package-plus">
                            <path d="M16 16h6" />
                            <path d="M19 13v6" />
                            <path
                                d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" />
                            <path d="m7.5 4.27 9 5.15" />
                            <polyline points="3.29 7 12 12 20.71 7" />
                            <line x1="12" x2="12" y1="22" y2="12" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-end">
                        <h1 class="font-bold text-lg">
                            ₱{{ number_format($data->where('category', 'supplies & materials')->sum('amount'), 2) }}
                        </h1>
                        <p class="text-xs text-[#989898]">
                            {{ $data->where('category', 'supplies & materials')->count() }}
                            Expenses</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium">Supplies & Materials</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-[#989898] lucide lucide-chevron-right-icon lucide-chevron-right {{ $category === 'supplies & materials' ? 'rotate-90' : '' }}">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </div>
            </button>
            <button wire:click="$set('category', 'miscellaneous')"
                class="min-w-63 shrink-0 flex flex-col bg-white rounded-lg p-6 gap-3 cursor-pointer {{ $category === 'miscellaneous' ? 'border-4 border-[#F97316]' : '' }}">
                <div class="flex items-center justify-between gap-10">
                    <div class="rounded bg-[#F97316] text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg"viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="size-6 lucide lucide-hand-coins-icon lucide-hand-coins">
                            <path d="M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17" />
                            <path
                                d="m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9" />
                            <path d="m2 16 6 6" />
                            <circle cx="16" cy="9" r="2.9" />
                            <circle cx="6" cy="5" r="3" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-end">
                        <h1 class="font-bold text-lg">
                            ₱{{ number_format($data->where('category', 'miscellaneous')->sum('amount'), 2) }}</h1>
                        <p class="text-xs text-[#989898]">{{ $data->where('category', 'miscellaneous')->count() }}
                            Expenses</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium">Miscellaneous</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-[#989898] lucide lucide-chevron-right-icon lucide-chevron-right {{ $category === 'miscellaneous' ? 'rotate-90' : '' }}">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </div>
            </button>
            <button wire:click="$set('category', 'other expenses')"
                class="min-w-63 shrink-0 flex flex-col bg-white rounded-lg p-6 gap-3 cursor-pointer {{ $category === 'other expenses' ? 'border-4 border-[#C034B0]' : '' }}">
                <div class="flex items-center justify-between gap-10">
                    <div class="rounded bg-[#C034B0] text-white p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                            class="size-6 lucide lucide-piggy-bank-icon lucide-piggy-bank">
                            <path
                                d="M11 17h3v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-3a3.16 3.16 0 0 0 2-2h1a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1h-1a5 5 0 0 0-2-4V3a4 4 0 0 0-3.2 1.6l-.3.4H11a6 6 0 0 0-6 6v1a5 5 0 0 0 2 4v3a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1z" />
                            <path d="M16 10h.01" />
                            <path d="M2 8v1a2 2 0 0 0 2 2h1" />
                        </svg>
                    </div>
                    <div class="flex flex-col text-end">
                        <h1 class="font-bold text-lg">
                            ₱{{ number_format($data->where('category', 'other expenses')->sum('amount'), 2) }}</h1>
                        <p class="text-xs text-[#989898]">{{ $data->where('category', 'other expenses')->count() }}
                            Expenses</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <p class="text-xs font-medium">Other Expenses</p>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="text-[#989898] lucide lucide-chevron-right-icon lucide-chevron-right {{ $category === 'other expenses' ? 'rotate-90' : '' }}">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </div>
            </button>
        </div>
    </div>
    <div class="bg-white rounded-md w-full flex flex-col p-4 font-poppins">
        <div class="flex items-center justify-between p-4 border-b border-[#E5E7EB]">
            <h1 class="text-[#203D3F] text-lg font-semibold capitalize">{{ $category }} Expenses</h1>
            <p class="text-[#999999]">{{ $data->where('category', $category)->count() }} Items</p>
        </div>
        @forelse ($expenses as $expense)
            <div
                class="flex items-center justify-between px-4 py-2 border-b border-[#E5E7EB] {{ $loop->last ? 'border-none' : '' }}">
                <div class="flex flex-col">
                    <h1 class="font-medium line-clamp-1">{{ $expense->title }}</h1>
                    <p class="text-[#999999] text-sm">
                        {{ \Carbon\Carbon::parse($expense->expense_date)->format('F d, Y') }}</p>
                </div>
                <p class="font-semibold">₱{{ number_format($expense->amount, 2) }}</p>
            </div>
        @empty
            <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                No Expenses found.
            </div>
        @endforelse

        <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-4">
            <p class="">Showing {{ $expenses->firstItem() ?? 0 }} to {{ $expenses->lastItem() }} of
                {{ $expenses->total() }}
                entries</p>
            <nav>
                <div class="flex items-center -space-x-px h-8">
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        @if ($expenses->onFirstPage()) disabled @endif
                        class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </button>

                    @foreach (range(1, $expenses->lastPage()) as $page)
                        <div wire:click="gotoPage({{ $page }})"
                            class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $expenses->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                            {{ $page }}
                        </div>
                    @endforeach


                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        @if (!$expenses->hasMorePages()) disabled @endif
                        class="flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[300px] md:max-w-lg gap-3 md:gap-6 w-full p-6 md:p-8 relative font-poppins flex flex-col justify-center">
                <h1 class="text-[#203D3F] md:text-lg font-semibold">Add New Expense</h1>
                <livewire:expense-form />
            </div>
        </div>
    @endif
</div>
