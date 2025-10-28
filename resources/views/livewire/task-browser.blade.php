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
                    <p class="text-sm font-medium">Category</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $allserviceCategories->count() }}</h1>
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
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Service</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $allServices->count() }}</h1>
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
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Total Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $taskCount }}</h1>
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
                    <p class="text-[0.6rem]">Today</p>
                    <p class="text-sm font-medium">Pending Task</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $pendingTaskCount }}</h1>
        </div>
    </div>

    @if ($activeTab == 'taskBrowse')
        <div class="flex flex-col gap-4 bg-white rounded-2xl p-4 font-poppins">
            <h1 class="text-[#203D3F] text-lg font-semibold">Service Request</h1>
            <div class="flex md:items-center justify-between flex-col-reverse md:flex-row gap-2 md:gap-0">
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

                <div class="flex items-center justify-between gap-4 md:gap-6">
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

                    <button wire:click="$set('activeTab', 'serviceBrowse')"
                        class="flex-1 cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md flex items-center text-white gap-4 md:gap-2">
                        <p class="text-sm">Service</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right">
                            <path d="M18 8L22 12L18 16" />
                            <path d="M2 12H22" />
                        </svg>
                    </button>
                </div>

            </div>
            <div class="w-full overflow-x-auto">
                <div class="min-w-[1010px] flex flex-col font-inter">
                    <div class="rounded-t-3xl bg-[#EEF2F5] w-full flex items-center text-center p-3">
                        <div class="w-[15%] text-start pl-1">Name</div>
                        <div class="w-[20%]">Category</div>
                        <div class="w-[20%]">Service</div>
                        <div class="w-[15%]">Assigned</div>
                        <div class="w-[10%]">Priority</div>
                        <div class="w-[10%]">Status</div>
                        <div class="w-[10%]">Action</div>
                    </div>
                    <div class="w-full flex flex-col text-center bg-white">
                        @forelse ($tasks as $task)
                            <div
                                class="w-full flex items-center text-sm border-x border-b border-[#EEF2F5] text-[#484848]">
                                <div
                                    class="w-[15%] text-start px-1 pl-3 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="truncate capitalize">{{ $task->customer_name }}</p>
                                </div>
                                <div
                                    class="w-[20%] text-center px-1 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="w-full truncate capitalize">
                                        {{ $task->service->serviceCategory->category }}</p>
                                </div>
                                <div
                                    class="w-[20%] text-center px-1 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="w-full truncate capitalize">{{ $task->service->service }}</p>
                                </div>
                                <div
                                    class="w-[15%] text-center px-1 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="w-full truncate capitalize">{{ $task->user->fullname }}</p>
                                </div>
                                <div
                                    class="w-[10%] text-center px-1 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="w-full truncate capitalize">{{ $task->priority }}</p>
                                </div>
                                <div
                                    class="w-[10%] text-center px-1 border-x border-[#EEF2F5] py-3.5 md:py-5.5 flex items-center gap-2">
                                    <p class="w-full truncate capitalize">{{ $task->status }}</p>
                                </div>
                                <div class="w-[10%] pr-4 py-3 flex items-center justify-center gap-2 text-xs">
                                    <button class="text-[#3B82F6] px-4 py-2 rounded cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
                                No Tasks found.
                            </div>
                        @endforelse
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2">
                    <p class="">Showing {{ $tasks->firstItem() ?? 0 }} to
                        {{ $tasks->lastItem() }} of
                        {{ $tasks->total() }}
                        entries</p>
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
            </div>
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

    @if ($activeTab == 'serviceBrowse')
        <div class="flex flex-col gap-4 bg-white rounded-2xl p-4 font-poppins">
            <h1 class="text-[#203D3F] text-lg font-semibold">Service List</h1>
            <div class="flex flex-col-reverse md:flex-row items-center justify-between w-full gap-2">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="relative text-[#797979] w-full md:w-auto">
                        <input wire:model.live="searchService" type="text" placeholder="Search service..."
                            class="text-sm md:text-base w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                    </div>
                    <div class="relative text-[#797979] w-full md:w-[200px]">
                        <select wire:model.live="selectedCategory"
                            class="w-full md:w-[200px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                            name="status" id="status">
                            <option value="all">All Category</option>
                            @foreach ($allserviceCategories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->category }}</option>
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
                <div
                    class="flex flex-col-reverse md:flex-row items-end md:items-center gap-2 md:gap-6 w-full md:w-auto">
                    <button type="button" wire:click="$set('showAddModal', true)"
                        class="text-sm md:text-base cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md flex items-center text-white gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                            <path d="M5 12h14" />
                            <path d="M12 5v14" />
                        </svg>
                        <p class="text-sm">Add Service</p>
                    </button>

                    <button wire:click="$set('activeTab', 'taskBrowse')"
                        class="text-sm md:text-base cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md flex items-center text-white gap-2">
                        <p class="text-sm">Task</p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-move-right-icon lucide-move-right">
                            <path d="M18 8L22 12L18 16" />
                            <path d="M2 12H22" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <div class="min-w-[720px] flex flex-col font-inter">
                    <div class="rounded-t-3xl bg-[#EEF2F5] w-full flex items-center text-center p-3">
                        <div class="w-[40%] text-start pl-1">Service Name</div>
                        <div class="w-[20%]">Available Task</div>
                        <div class="w-[25%]">Category</div>
                        <div class="w-[15%]">Actions</div>
                    </div>
                    <div class="w-full flex flex-col text-center bg-white">
                        @forelse ($services as $service)
                            <div
                                class="w-full flex items-center text-sm border-x border-b border-[#EEF2F5] text-[#484848]">
                                <div
                                    class="w-[40%] text-start px-1 pl-3 border-x border-[#EEF2F5] py-4 flex items-center gap-2 pr-8">
                                    {{ $service->service }}
                                </div>
                                <div class="w-[20%] py-4 px-1">
                                    {{ $service->tasks->whereIn('status', ['pending', 'unassigned'])->count() }}
                                </div>
                                <div class="w-[25%] py-4 px-1 border-x border-[#EEF2F5]">
                                    {{ $service->serviceCategory->category }}
                                </div>
                                <div class="w-[15%] pr-4 py-3 flex items-center justify-center gap-2 text-xs">
                                    <button wire:click="selectEditService({{ $service->id }})" type="button"
                                        class="cursor-pointer text-[#3B82F6]">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-square-pen-icon lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path
                                                d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                        </svg>
                                    </button>
                                    <button wire:click='removeService({{ $service->id }})'
                                        class="cursor-pointer text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trash2-icon lucide-trash-2">
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                                No Category found.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2">
                <p class="">Showing {{ $services->firstItem() ?? 0 }} to
                    {{ $services->lastItem() }} of
                    {{ $services->total() }}
                    entries</p>
                <nav>
                    <div class="flex items-center -space-x-px h-8">
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            @if ($services->onFirstPage()) disabled @endif
                            class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </button>

                        @foreach (range(1, $services->lastPage()) as $page)
                            <div wire:click="gotoPage({{ $page }})"
                                class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $services->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                                {{ $page }}
                            </div>
                        @endforeach


                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            @if (!$services->hasMorePages()) disabled @endif
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
        </div>
        <div class="flex flex-col gap-4 bg-white rounded-2xl p-4 font-poppins">
            <h1 class="text-[#203D3F] text-lg font-semibold">Category List</h1>
            <div class="flex flex-col-reverse md:flex-row items-center justify-between w-full gap-2">
                <div class="relative text-[#797979] w-full md:w-auto">
                    <input wire:model.live="searchCat" type="text" placeholder="Search category..."
                        class="text-sm md:text-base w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
                <div
                    class="flex flex-col-reverse md:flex-row items-end md:items-center gap-2 md:gap-6 w-full md:w-auto">

                    <div class="flex items-center gap-4 w-full">
                        <div class="relative w-full text-[#797979]">

                            <input wire:model.live="catName" type="text" placeholder="Category Name..."
                                class="text-sm md:text-base w-full pr-[100px] pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />

                            <button wire:click='createCategory'
                                class="cursor-pointer absolute right-1 top-1 bottom-1 px-4 bg-[#203D3F] rounded-md flex items-center text-white gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-plus-icon lucide-plus">
                                    <path d="M5 12h14" />
                                    <path d="M12 5v14" />
                                </svg>
                                <p class="text-sm">Add</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full overflow-x-auto">
                <div class="min-w-[720px] flex flex-col font-inter">
                    <div class="rounded-t-3xl bg-[#EEF2F5] w-full flex items-center text-center p-3">
                        <div class="w-[40%] text-start pl-1">Category Name</div>
                        <div class="w-[20%]">No. of Service</div>
                        <div class="w-[25%]">Created At</div>
                        <div class="w-[15%]">Actions</div>
                    </div>
                    <div class="w-full flex flex-col text-center bg-white">
                        @forelse ($serviceCategories as $category)
                            <div
                                class="w-full flex items-center text-sm border-x border-b border-[#EEF2F5] text-[#484848]">
                                <div
                                    class="w-[40%] text-start px-1 pl-3 border-x border-[#EEF2F5] py-4 flex items-center gap-2 pr-8">
                                    <input wire:input.debounce.300ms="$set('newCatName', $event.target.value)"
                                        type="text" value="{{ $category->category }}"
                                        @if ($catEditingId !== $category->id) readonly @endif
                                        class="focus:outline-none line-clamp-1 capitalize w-full {{ $catEditingId === $category->id ? 'border-b py-1' : 'bg-transparent' }}" />
                                </div>
                                <div class="w-[20%] py-4 px-1">
                                    {{ count($category->services) }}
                                </div>
                                <div class="w-[25%] py-4 px-1 border-x border-[#EEF2F5]">
                                    {{ \Carbon\Carbon::parse($category->created_at)->format('F d, Y') }}
                                </div>
                                <div class="w-[15%] pr-4 py-3 flex items-center justify-center gap-2 text-xs">
                                    <button wire:click='editCategory({{ $category->id }})'
                                        class="cursor-pointer text-[#3B82F6]">
                                        @if ($catEditingId == $category->id)
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-save-icon lucide-save">
                                                <path
                                                    d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z" />
                                                <path d="M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7" />
                                                <path d="M7 3v4a1 1 0 0 0 1 1h7" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-square-pen-icon lucide-square-pen">
                                                <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path
                                                    d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z" />
                                            </svg>
                                        @endif
                                    </button>
                                    <button wire:click='removeCategory({{ $category->id }})'
                                        class="cursor-pointer text-red-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="lucide lucide-trash2-icon lucide-trash-2">
                                            <path d="M10 11v6" />
                                            <path d="M14 11v6" />
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6" />
                                            <path d="M3 6h18" />
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                                No Category found.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2">
                <p class="">Showing {{ $serviceCategories->firstItem() ?? 0 }} to
                    {{ $serviceCategories->lastItem() }} of
                    {{ $serviceCategories->total() }}
                    entries</p>
                <nav>
                    <div class="flex items-center -space-x-px h-8">
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            @if ($serviceCategories->onFirstPage()) disabled @endif
                            class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </button>

                        @foreach (range(1, $serviceCategories->lastPage()) as $page)
                            <div wire:click="gotoPage({{ $page }})"
                                class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $serviceCategories->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                                {{ $page }}
                            </div>
                        @endforeach


                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            @if (!$serviceCategories->hasMorePages()) disabled @endif
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
        </div>
    @endif

    @if ($showAddModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[300px] md:max-w-lg gap-3 md:gap-6 w-full p-6 md:p-8 relative font-poppins flex flex-col justify-center">
                <h1 class="text-[#203D3F] md:text-lg font-semibold">Add New Service</h1>
                <div class="flex flex-col gap-2">
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Service Name</p>
                        <input wire:model.live="newServiceName" type="text" placeholder="e.g. Signal Installation"
                            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
                    </div>
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Category</p>
                        <div class="text-sm md:text-base flex items-center flex-1 relative text-[#797979]">
                            <select wire:model.live="newCategory"
                                class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                                <option value="all">All Category</option>
                                @foreach ($allserviceCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Price(₱)</p>
                        <input wire:model.live="newAmount" type="number" step="0.01"
                            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 md:mt-6">
                    <button type="button" wire:click="$set('showAddModal', false)"
                        class="w-full flex-1 py-2 border border-[#4f4f4f] rounded-md text-xs md:text-sm cursor-pointer">
                        Cancel
                    </button>
                    <button wire:click="createService"
                        class="w-full flex-1 py-2 bg-[#203D3F] rounded-md text-xs md:text-sm text-white cursor-pointer">
                        Create Service
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($showEditModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[300px] md:max-w-lg gap-3 md:gap-6 w-full p-6 md:p-8 relative font-poppins flex flex-col justify-center">
                <h1 class="text-[#203D3F] md:text-lg font-semibold">Add New Service</h1>
                <div class="flex flex-col gap-2">
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Service Name</p>
                        <input wire:model.live="editServiceName" type="text"
                            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
                    </div>
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Category</p>
                        <div class="text-sm md:text-base flex items-center flex-1 relative text-[#797979]">
                            <select wire:model.live="editCategory"
                                class="w-full px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                                <option value="all">All Category</option>
                                @foreach ($allserviceCategories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category }}</option>
                                @endforeach
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex flex-col text-[#4f4f4f] gap-1">
                        <p class="text-xs md:text-sm font-medium">Price(₱)</p>
                        <input wire:model.live="editAmount" type="number" step="0.01"
                            class="text-sm md:text-base w-full pl-4 py-2 border border-gray-500 rounded-md focus:outline-none text-[#797979]" />
                    </div>
                </div>
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-4 md:mt-6">
                    <button type="button" wire:click="$set('showEditModal', false)"
                        class="w-full flex-1 py-2 border border-[#4f4f4f] rounded-md text-xs md:text-sm cursor-pointer">
                        Cancel
                    </button>
                    <button wire:click="editService({{ $editServiceId }})"
                        class="w-full flex-1 py-2 bg-[#203D3F] rounded-md text-xs md:text-sm text-white cursor-pointer">
                        Save Service
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
