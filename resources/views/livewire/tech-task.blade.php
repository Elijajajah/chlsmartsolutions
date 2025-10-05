<div class="flex flex-col md:flex-row gap-4 w-full">
    <div class="w-full md:w-[70%] flex flex-col gap-3 font-poppins">
        <div class="flex flex-col md:flex-row md:items-center text-xs gap-2 md:gap-4">
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
            <div class="relative text-[#797979]">
                <select wire:change="$set('selectedPrio', $event.target.value)"
                    class="w-full md:w-[225px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                    name="priority" id="priority">
                    <option value="all">All Priorities</option>
                    <option value="high">High Priority</option>
                    <option value="medium">Medium Priority</option>
                    <option value="low">Low Priority</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <div class="md:hidden">
                <button popovertarget="cally-popover1"
                    class="flex items-center justify-between text-[#797979] w-full border border-gray-500 rounded-md focus:outline-none"
                    style="anchor-name:--cally1">
                    <p id="cally1" class="px-4 py-2">
                        {{ \Carbon\Carbon::parse($selectedDate)->format('F d, Y') }}
                    </p>
                    <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="22" height="22"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M8 2v4" />
                        <path d="M16 2v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18" />
                        <path d="m9 16 2 2 4-4" />
                    </svg>
                </button>
                <div popover id="cally-popover1" class="dropdown bg-base-100 rounded-box shadow-lg"
                    style="position-anchor:--cally1">
                    <calendar-date class="cally font-poppins" first-day-of-week="0" format-weekday="short"
                        value="{{ $selectedDate }}" wire:change="$set('selectedDate', $event.target.value)"
                        onchange="document.getElementById('cally1').innerText = new Date(this.value).toLocaleDateString('en-US', { month: 'long', day: '2-digit', year: 'numeric' })">
                        <svg aria-label="Previous" slot="previous" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-left-icon lucide-chevron-left">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                        <svg aria-label="Next" slot="next" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-chevron-right-icon lucide-chevron-right">
                            <path d="m9 18 6-6-6-6" />
                        </svg>

                        <calendar-month class="text-sm p-0 font-inter"></calendar-month>
                    </calendar-date>
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <div class="bg-white w-[768px] md:w-full flex flex-col items-center rounded-t-md h-fit pb-2">
                <div
                    class="w-full bg-[#E7E7E7] rounded-t-md flex items-center text-center p-2 font-inter text-sm text-[#3A3A3A]">
                    <div class="w-[8%] pl-2"></div>
                    <div class="w-[27.5%] text-start">Task</div>
                    <div class="w-[17.5%]">Priority</div>
                    <div class="w-[17.5%]">Due Date</div>
                    <div class="w-[17.5%]">Status</div>
                    <div class="w-[13%]">Actions</div>
                </div>
                <div class="w-full flex flex-col border-x border-b border-[#EEF2F5]">
                    @forelse ($tasks as $task)
                        <div
                            class="w-full flex items-center text-center text-xs border-b border-[#EEF2F5] last:border-none text-[#484848]">
                            <div class="w-[8%] h-full flex items-center justify-center">
                                {{ $task->id }}
                            </div>
                            <div class="w-[27.5%] text-start border-x border-[#EEF2F5] pl-2 py-4.5 h-full capitalize">
                                {{ $task->title }}
                            </div>
                            <div class="w-[17.5%] py-2 flex items-center justify-center h-full">
                                @if ($task->priority == 'low')
                                    <div class="bg-[#0000001A] py-2 px-4 w-fit rounded-full">
                                        <p class="text-[#9A9A9A] text-[0.6rem] capitalize">{{ $task->priority }}</p>
                                    </div>
                                @elseif ($task->priority == 'medium')
                                    <div class="bg-[#C830C31A] py-2 px-4 w-fit rounded-full">
                                        <p class="text-[#C31BD2] text-[0.6rem] capitalize">{{ $task->priority }}</p>
                                    </div>
                                @else
                                    <div class="bg-[#DC26261A] py-2 px-4 w-fit rounded-full">
                                        <p class="text-[#DC2626] text-[0.6rem] capitalize">{{ $task->priority }}</p>
                                    </div>
                                @endif
                            </div>
                            <div class="w-[17.5%] border-x border-[#EEF2F5] py-4.5 h-full">
                                {{ \Carbon\Carbon::parse($task->expiry_date)->format('F d, Y') }}</div>
                            <div class="w-[17.5%] py-2 flex items-center justify-center h-full">
                                @if ($task->status == 'pending')
                                    <div
                                        class="bg-[#ffeaba] py-2 px-4 w-fit rounded-full text-[#c77a0e] flex gap-1 items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                            <circle cx="12" cy="12" r="1" />
                                            <circle cx="19" cy="12" r="1" />
                                            <circle cx="5" cy="12" r="1" />
                                        </svg>
                                        <p class="text-[0.6rem] capitalize">{{ $task->status }}</p>
                                    </div>
                                @elseif ($task->status == 'completed')
                                    <div
                                        class="bg-[#c1eacad7] py-2 px-4 w-fit rounded-full text-[#16A34A] flex gap-1 items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-check-icon lucide-check">
                                            <path d="M20 6 9 17l-5-5" />
                                        </svg>
                                        <p class="text-[0.6rem] capitalize">{{ $task->status }}</p>
                                    </div>
                                @else
                                    <div
                                        class="bg-[#dc262633] py-2 px-4 w-fit rounded-full text-[#DC2626] flex gap-1 items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-x-icon lucide-x">
                                            <path d="M18 6 6 18" />
                                            <path d="m6 6 12 12" />
                                        </svg>
                                        <p class="text-[0.6rem] capitalize">{{ $task->status }}</p>
                                    </div>
                                @endif

                            </div>
                            <div
                                class="w-[13%] border-l border-[#EEF2F5] py-4 pr-2 flex items-center justify-center h-full">
                                <button wire:click='selectTask({{ $task->id }})'
                                    class="cursor-pointer text-[#3B82F6]">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-square-pen-icon lucide-square-pen">
                                        <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path
                                            d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                            No tasks found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div
            class="w-full flex flex-col md:flex-row gap-2 items-center justify-between text-xs h-fit p-2 bg-white -mt-3 rounded-b-md">
            <p class="">Showing {{ $tasks->firstItem() ?? 0 }} to {{ $tasks->lastItem() }} of
                {{ $tasks->total() }}
                entries</p>
            <nav>
                <div class="flex items-center -space-x-px h-8 text-xs">
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        @if ($tasks->onFirstPage()) disabled @endif
                        class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </button>

                    @foreach (range(1, $tasks->lastPage()) as $page)
                        <div wire:click="gotoPage({{ $page }})"
                            class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $tasks->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                            {{ $page }}
                        </div>
                    @endforeach


                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        @if (!$tasks->hasMorePages()) disabled @endif
                        class="flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Next</span>
                        <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
                        </svg>
                    </button>
                </div>
            </nav>
        </div>
    </div>
    <div class="flex flex-col items-center w-full md:w-[30%] h-fill gap-4">
        <div class="bg-white flex flex-col w-full rounded-md font-poppins max-h-[365px] mb-4 md:mb-0">
            <div class="flex items-center px-4 pt-4 gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                        clip-rule="evenodd" />
                </svg>
                <p class="font-semibold">Recent Activity</p>
            </div>
            <div class="flex flex-col px-4 max-h-[295px] overflow-hidden overflow-y-auto custom-scrollbar py-2">
                @forelse ($logs as $log)
                    <div class="border-b border-[#EEF2F5] last:border-none py-3">
                        <p class="text-xs">{{ \Carbon\Carbon::parse($log->created_at)->format('F d') }}: Task
                            #{{ $log->task_id }} marked as completed</p>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center p-6 text-[#BDBEC3] gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-scroll-text-icon lucide-scroll-text">
                            <path d="M15 12h-5" />
                            <path d="M15 8h-5" />
                            <path d="M19 17V5a2 2 0 0 0-2-2H4" />
                            <path
                                d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3" />
                        </svg>
                        <p class="text-xs mt-1">No Recent Activity</p>
                    </div>
                @endforelse
            </div>
        </div>
        <div class="bg-white hidden md:flex flex-row justify-center w-full rounded-md shadow px-4 py-2">
            <calendar-date class="cally font-poppins" first-day-of-week="0" format-weekday="short"
                value="{{ $selectedDate }}" wire:change="$set('selectedDate', $event.target.value)">
                <svg aria-label="Previous" slot="previous" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-left-icon lucide-chevron-left">
                    <path d="m15 18-6-6 6-6" />
                </svg>
                <svg aria-label="Next" slot="next" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-chevron-right-icon lucide-chevron-right">
                    <path d="m9 18 6-6-6-6" />
                </svg>
                <calendar-month class="text-sm p-0 font-inter"></calendar-month>
            </calendar-date>
        </div>

    </div>

    @if ($showModal && $selectedTask)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[280px] md:max-w-lg gap-4 w-full p-8 relative font-inter flex flex-col items-center justify-center">
                <div class="flex flex-col w-full gap-4">
                    <div class="flex flex-col font-poppins">
                        <h1 class="font-semibold md:text-xl">Task Details</h1>
                        <p class="text-[0.6rem] md:text-xs">Task
                            #{{ str_pad($selectedTask->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="flex flex-col gap-2">
                        <p class="font-poppins font-semibold capitalize text-sm md:text-base">
                            {{ $selectedTask->title }}</p>
                        <div class="flex items-center gap-4">
                            @if ($selectedTask->priority == 'low')
                                <div class="bg-[#0000001A] py-1 md:py-2 px-4 w-fit rounded-full">
                                    <p class="text-[#9A9A9A] text-[0.6rem] capitalize">{{ $selectedTask->priority }}
                                    </p>
                                </div>
                            @elseif ($selectedTask->priority == 'medium')
                                <div class="bg-[#C830C31A] py-1 md:py-2 px-4 w-fit rounded-full">
                                    <p class="text-[#C31BD2] text-[0.6rem] capitalize">{{ $selectedTask->priority }}
                                    </p>
                                </div>
                            @else
                                <div class="bg-[#DC26261A] py-1 md:py-2 px-4 w-fit rounded-full">
                                    <p class="text-[#DC2626] text-[0.6rem] capitalize">{{ $selectedTask->priority }}
                                    </p>
                                </div>
                            @endif

                            @if ($selectedTask->status == 'pending')
                                <div
                                    class="bg-[#ffeaba] py-1 md:py-2 px-4 w-fit rounded-full text-[#c77a0e] flex gap-1 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                        <circle cx="12" cy="12" r="1" />
                                        <circle cx="19" cy="12" r="1" />
                                        <circle cx="5" cy="12" r="1" />
                                    </svg>
                                    <p class="text-[0.6rem] capitalize">{{ $selectedTask->status }}</p>
                                </div>
                            @elseif ($selectedTask->status == 'completed')
                                <div
                                    class="bg-[#c1eacad7] py-1 md:py-2 px-4 w-fit rounded-full text-[#16A34A] flex gap-1 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-check-icon lucide-check">
                                        <path d="M20 6 9 17l-5-5" />
                                    </svg>
                                    <p class="text-[0.6rem] capitalize">{{ $selectedTask->status }}</p>
                                </div>
                            @else
                                <div
                                    class="bg-[#dc262633] py-1 md:py-2 px-4 w-fit rounded-full text-[#DC2626] flex gap-1 items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="lucide lucide-x-icon lucide-x">
                                        <path d="M18 6 6 18" />
                                        <path d="m6 6 12 12" />
                                    </svg>
                                    <p class="text-[0.6rem] capitalize">{{ $selectedTask->status }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <div class="flex flex-col md:flex-row gap-4 md:justify-between">
                        <div class="flex flex-col gap-1 md:gap-2">
                            <p class="font-medium text-xs md:text-sm">Due Date:</p>
                            <p class="text-[0.6rem] md:text-xs text-[#747474]">
                                {{ \Carbon\Carbon::parse($selectedTask->expiry_date)->format('F d, Y') }}</p>
                        </div>
                        <div class="flex flex-col gap-1 md:gap-2">
                            <p class="font-medium text-xs md:text-sm">Customer Information</p>
                            <div class="flex items-center gap-2 text-[#747474]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-4 md:size-5">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-[0.6rem] md:text-xs">{{ $selectedTask->customer_name }}</p>
                            </div>
                            <div class="flex items-center gap-2 text-[#747474]">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-3.5 md:size-4.5">
                                    <path fill-rule="evenodd"
                                        d="M19.5 9.75a.75.75 0 0 1-.75.75h-4.5a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 1 1.5 0v2.69l4.72-4.72a.75.75 0 1 1 1.06 1.06L16.06 9h2.69a.75.75 0 0 1 .75.75Z"
                                        clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                        d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-[0.6rem] md:text-xs">(+63) {{ $selectedTask->customer_phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col w-full gap-2">
                    <p class="font-semibold text-xs md:text-sm">Description:</p>
                    <p class="text-[0.6rem] md:text-xs text-justify text-[#828282]">
                        {{ $selectedTask->description }}
                    </p>
                </div>
                <div class="flex items-center justify-center text-xs md:text-base w-full gap-4 mt-3 md:mt-6">
                    <button wire:click='updateStatus({{ $selectedTask->id }})'
                        class="cursor-pointer flex gap-1 md:gap-2 items-center py-2 px-4 bg-[#16A34A] rounded-md text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4 md:size-5" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="lucide lucide-circle-check-big-icon lucide-circle-check-big">
                            <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                            <path d="m9 11 3 3L22 4" />
                        </svg>
                        <p class="whitespace-nowrap">Mark as done</p>
                    </button>
                    <button wire:click='closeModal'
                        class="cursor-pointer flex gap-2 items-center py-2 px-4 bg-red-500 rounded-md text-white">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>
