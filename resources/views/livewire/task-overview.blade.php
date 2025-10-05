<div class="w-full bg-white rounded-lg flex flex-col p-4">
    <h1 class="text-[#203D3F] font-semibold">Task Overview</h1>
    <p class="text-[0.6rem] text-[#BDBEC3] mb-2">Pending Task Today</p>
    <div class="flex flex-col gap-2">
        @forelse ($tasks as $task)
            @if ($task->priority == 'high')
                <div class="flex items-center justify-between p-2 text-sm rounded-sm w-full border border-[#BFBFBF]">
                    <p class="line-clamp-1 capitalize w-[70%]">{{ $task->title }}</p>
                    <p class="text-[#DC2626] font-medium text-xs">High</p>
                </div>
            @elseif ($task->priority == 'medium')
                <div class="flex items-center justify-between p-2 text-sm rounded-sm w-full border border-[#BFBFBF]">
                    <p class="line-clamp-1 capitalize w-[70%]">{{ $task->title }}</p>
                    <p class="text-[#C31BD2] font-medium text-xs">Medium</p>
                </div>
            @else
                <div class="flex items-center justify-between p-2 text-sm rounded-sm w-full border border-[#BFBFBF]">
                    <p class="line-clamp-1 capitalize w-[70%]">{{ $task->title }}</p>
                    <p class="text-[#9A9A9A] font-medium text-xs">Low</p>
                </div>
            @endif
        @empty
            <div class="flex flex-col items-center justify-center pt-8 pb-7 text-[#BDBEC3] gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-clipboard-list-icon lucide-clipboard-list">
                    <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                    <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                    <path d="M12 11h4" />
                    <path d="M12 16h4" />
                    <path d="M8 11h.01" />
                    <path d="M8 16h.01" />
                </svg>
                <p class="text-xs mt-1">No Task Available</p>
            </div>
        @endforelse
    </div>
    @if ($tasks->count() >= $take)
        <div wire:click="setActive('task')" class="flex py-2 text-sm cursor-pointer">
            <p class="text-[#203D3F] font-medium">See more...</p>
        </div>
    @endif
</div>
