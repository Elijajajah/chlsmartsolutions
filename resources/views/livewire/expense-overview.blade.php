<div class="w-full bg-white rounded-lg flex flex-col p-4">
    <h1 class="text-[#203D3F] font-semibold">Expenses Overview</h1>
    <p class="text-[0.6rem] text-[#BDBEC3] mb-2">Recent transactions</p>
    @forelse ($expenses as $expense)
        <div class="flex items-center justify-between py-2 gap-2 text-sm">
            <p class="w-1/2 whitespace-nowrap">{{ \Carbon\Carbon::parse($expense->expense_date)->format('F d, Y') }}</p>
            <p class="text-[#FF7555] font-medium">₱{{ number_format($expense->amount, 2) }}</p>
        </div>
    @empty
        <div class="flex flex-col items-center justify-center p-6 text-[#BDBEC3] gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="lucide lucide-file-text-icon lucide-file-text">
                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z" />
                <path d="M14 2v4a2 2 0 0 0 2 2h4" />
                <path d="M10 9H8" />
                <path d="M16 13H8" />
                <path d="M16 17H8" />
            </svg>
            <p class="text-xs mt-1">No Expenses Available</p>
        </div>
    @endforelse
    @if ($expenses->count() >= $take)
        <div wire:click="setActive('expense')" class="flex py-2 text-sm cursor-pointer">
            <p class="text-[#203D3F] font-medium">See more...</p>
        </div>
    @endif
</div>
