<div class="flex flex-col gap-4 w-full">
    <div class="flex items-start md:items-center justify-between w-full">
        <div class="flex flex-col md:flex-row md:items-center text-xs gap-4">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-list-filter-icon lucide-list-filter">
                    <path d="M3 6h18" />
                    <path d="M7 12h10" />
                    <path d="M10 18h4" />
                </svg>
                <p>Filter by:</p>
            </div>
            <div class="relative">
                <select wire:change="$set('selectedMessage', $event.target.value)"
                    class="w-[225px] px-4 py-2 text-[#4E4E4E] border border-gray-500 rounded-md focus:outline-none appearance-none"
                    name="message" id="message">
                    <option value="0">All Message</option>
                    <option value="1">Unread Message</option>
                    <option value="2">Read Message</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                    <svg class="w-6 h-6 text-[#797979]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
        <button wire:click='markAllAsRead()' class="cursor-pointer">
            <p class="text-white bg-[#7da163] px-4 py-2 text-xs md:text-sm rounded-md">Mark all as read</p>
        </button>
    </div>
    <div wire:poll.3s class="flex flex-col gap-4 w-full h-screen md:h-full">
        @forelse ($notifications as $notification)
            <div type="button" wire:click="markAsRead({{ $notification->id }})"
                class="w-full transition cursor-pointer
                    {{ $notification->read_at ? 'bg-[#F0F0F0]' : 'bg-white' }} text-[#203D3F] flex flex-col gap-1 relative font-poppins p-4 rounded-md">
                <p class="absolute top-4 right-4 text-[0.6rem] md:text-xs text-[#4E4E4E]">
                    {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</p>
                <h1 class="font-semibold text-sm md:text-base">{{ $notification->title }}</h1>
                <p class="text-[#4E4E4E] text-xs md:text-sm">{{ $notification->message }}</p>
            </div>
        @empty
            <div class="flex py-38 items-center justify-center text-gray-400">
                No Notification Available
            </div>
        @endforelse
    </div>


</div>
