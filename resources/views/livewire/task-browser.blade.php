<div class="flex flex-col gap-4 md:gap-6">
    <div class="flex flex-col md:flex-row items-center font-poppins gap-2 md:gap-4">
        <div
            class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-6 py-4 border-l-6 border-blue-600">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-blue-600">
                    <path fill-rule="evenodd"
                        d="M10.5 3A1.501 1.501 0 0 0 9 4.5h6A1.5 1.5 0 0 0 13.5 3h-3Zm-2.693.178A3 3 0 0 1 10.5 1.5h3a3 3 0 0 1 2.694 1.678c.497.042.992.092 1.486.15 1.497.173 2.57 1.46 2.57 2.929V19.5a3 3 0 0 1-3 3H6.75a3 3 0 0 1-3-3V6.257c0-1.47 1.073-2.756 2.57-2.93.493-.057.989-.107 1.487-.15Z"
                        clip-rule="evenodd" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Total Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getTask() }}</h1>
        </div>
        <div
            class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-6 py-4 border-l-6 border-[#F97316]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#F97316]">
                    <path fill-rule="evenodd"
                        d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                        clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                        d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z"
                        clip-rule="evenodd" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Today</p>
                    <p class="text-sm font-medium">Pending Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getTask('pending') }}</h1>
        </div>
        <div
            class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-6 py-4 border-l-6 border-[#22C55E]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#22C55E]">
                    <path fill-rule="evenodd"
                        d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                        clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                        d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z"
                        clip-rule="evenodd" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Today</p>
                    <p class="text-sm font-medium">Finished Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getTask('completed') }}</h1>
        </div>
        <div
            class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-6 py-4 border-l-6 border-[#DC2626]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#DC2626]">
                    <path fill-rule="evenodd"
                        d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 0 1-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0 1 13.5 1.5H15a3 3 0 0 1 2.663 1.618ZM12 4.5A1.5 1.5 0 0 1 13.5 3H15a1.5 1.5 0 0 1 1.5 1.5H12Z"
                        clip-rule="evenodd" />
                    <path
                        d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 0 1 9 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0 1 16.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625v-12Z" />
                    <path
                        d="M10.5 10.5a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963 5.23 5.23 0 0 0-3.434-1.279h-1.875a.375.375 0 0 1-.375-.375V10.5Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Missed Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getTask('missed') }}</h1>
        </div>
    </div>

    <div class="flex flex-col w-full gap-4 font-poppins bg-white rounded-md p-6">
        <h1 class="text-lg font-semibold">Technicians</h1>
        <div class="flex justify-center w-full">
            <div
                class="flex gap-4 overflow-x-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 w-full pb-4">
                @forelse ($technicians as $technician)
                    <div class="rounded-md border border-[#898989] p-4 bg-white min-w-[220px]">
                        <div class="flex items-center justify-between mb-2 gap-4">
                            <div class="flex flex-col">
                                <h1 class="font-medium text-sm">{{ $technician->fullname }}</h1>
                                <p class="text-[0.6rem] capitalize">{{ $technician->technicianRole->role }} Technician
                                </p>
                            </div>
                            <div class="bg-[#E5F1E8] text-[#16A34A] py-1 px-3 rounded-full text-xs font-medium">
                                Available
                            </div>
                        </div>
                        <div class="flex items-baseline justify-between text-xs text-gray-500">
                            <p>Task Today</p>
                            <div
                                class="rounded-full flex items-center w-8 h-8 justify-center bg-[#3B82F6]/20 text-[#1E3A8A] text-lg font-semibold">
                                {{ count($technician->tasks) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-[#797979] font-medium text-lg">No Technician Available</p>
                @endforelse
            </div>
        </div>
    </div>

    @if ($activeTab == 'taskBrowse')
        <div class="flex flex-col rounded-md gap-6 relative">
            <div class="flex flex-col-reverse md:flex-row items-end md:items-center justify-between gap-4">
                <div class="flex flex-col md:flex-row gap-4 w-full">
                    <div class="relative text-[#797979] w-full md:w-[200px]">
                        <select wire:change="$set('selectedStatus', $event.target.value)"
                            class="w-full md:w-[200px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                            name="status" id="status">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="missed">Missed</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                        </div>
                    </div>
                    <div class="relative text-[#797979] w-full md:w-[200px]">
                        <select wire:change="$set('selectedPrio', $event.target.value)"
                            class="w-full md:w-[200px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                            name="priority" id="priority">
                            <option value="all">All Priority</option>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                        </div>
                    </div>

                </div>
                <button wire:click="$set('activeTab', 'addTask')"
                    class="flex-1 cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md flex items-center text-white gap-2 whitespace-nowrap">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    <p class="text-sm">Add New Task</p>
                </button>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 font-poppins">
                @forelse ($tasks as $task)
                    <div class="flex flex-col gap-3 p-4 rounded-md shadow-md bg-white">
                        <div class="flex flex-col">
                            <div class="flex items-center justify-between">
                                <div class="flex flex-col">
                                    <h1 class="font-medium capitalize">{{ $task->title }}</h1>
                                    <p class="text-[0.6rem] text-[#797979]">Task Overview</p>
                                </div>
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
                            <div class="flex items-center gap-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5 text-blue-600">
                                    <path fill-rule="evenodd"
                                        d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm">{{ $task->customer_name }}</p>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-4.5 text-blue-600">
                                    <path fill-rule="evenodd"
                                        d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="text-sm">+63{{ $task->customer_phone }}</p>
                            </div>
                        </div>
                        <div class="relative text-[#797979] text-sm">
                            <select wire:change="updatePriority({{ $task->id }}, $event.target.value)"
                                class="capitalize w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                                name="priority" id="priority">
                                <option value="low" {{ $task->priority === 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ $task->priority === 'medium' ? 'selected' : '' }}>Medium
                                </option>
                                <option value="high" {{ $task->priority === 'high' ? 'selected' : '' }}>High
                                </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                            </div>
                        </div>
                        <div class="relative text-[#797979] text-sm">
                            <select wire:change="updateAssignedTech({{ $task->id }}, $event.target.value)"
                                class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                                name="technician" id="technician">

                                <option value="" {{ !$task->user_id ? 'selected' : '' }}>Select Technician
                                </option>

                                @foreach ($technicians as $tech)
                                    <option value="{{ $tech->id }}"
                                        {{ $task->user_id == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->fullname }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-1 sm:col-span-2 md:col-span-3 text-center text-gray-500">
                        No tasks available.
                    </div>
                @endforelse
            </div>
            <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2 pb-4 md:pb-0">
                <p class="">Showing {{ $tasks->firstItem() ?? 0 }} to {{ $tasks->lastItem() }} of
                    {{ $tasks->total() }} entries</p>
                <nav>
                    <div class="flex items-center -space-x-px h-8">
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            @if ($tasks->onFirstPage()) disabled @endif
                            class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
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
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                        </button>
                    </div>
                </nav>
            </div>

            <button wire:click="$set('activeTab', 'addTask')"
                class="md:hidden fixed bottom-6 right-6 z-20 bg-[#203D3F] hover:bg-[#182f31] text-white rounded-full shadow-lg p-3 flex items-center justify-center transition-colors duration-200"
                style="box-shadow: 0 4px 16px rgba(32,61,63,0.15);">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
            </button>
        </div>
    @endif

    @if ($activeTab == 'addTask')
        <div class="flex flex-col rounded-md gap-6 bg-white font-poppins p-6 w-full">
            <div class="flex items-center mb-2 gap-4">
                <button wire:click="$set('activeTab', 'taskBrowse')" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-undo2-icon lucide-undo-2">
                        <path d="M9 14 4 9l5-5" />
                        <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11" />
                    </svg>
                </button>
                <h1 class="text-lg font-semibold">Create a New Task</h1>
            </div>
            <livewire:task-form />
        </div>
    @endif
</div>
