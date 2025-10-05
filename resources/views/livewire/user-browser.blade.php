<div class="flex flex-col gap-4 md:gap-6 pb-4 md:pb-0">
    <div class="flex flex-col md:flex-row items-center font-poppins gap-2 md:gap-4 w-full">
        <div class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-10 py-4 border-l-6 border-blue-600">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-blue-600">
                    <path fill-rule="evenodd"
                        d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                        clip-rule="evenodd" />
                    <path
                        d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Total Active</p>
                    <p class="text-sm font-medium">Staffs</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getStaff('staff') }}</h1>
        </div>
        <div class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-10 py-4 border-l-6 border-[#DC2626]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                class="size-9 text-[#DC2626]">
                <path
                    d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
            </svg>
            <div class="flex flex-col">
                <p class="text-[0.6rem]">Active</p>
                <p class="text-sm font-medium">Admin Officer</p>
            </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getStaff('admin_officer') }}</h1>
        </div>
        <div class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-10 py-4 border-l-6 border-[#22C55E]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#22C55E]">
                    <path
                        d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Active</p>
                    <p class="text-sm font-medium">Cashier</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getStaff('cashier') }}</h1>
        </div>
        <div class="w-full flex-1 flex items-center justify-between bg-white rounded-lg pl-4 px-10 py-4 border-l-6 border-[#F97316]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#F97316]">
                    <path
                        d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Active</p>
                    <p class="text-sm font-medium">Technician</p>
                </div>
            </div>
            <h1 class="ml-4 text-2xl font-extrabold">{{ $this->getStaff('technician') }}</h1>
        </div>
    </div>

    <div class="bg-white rounded-md w-full flex flex-col gap-4 p-4 font-poppins">
        <div class="flex items-center w-full justify-between flex-col md:flex-row gap-4">
            <div class="flex items-center gap-4 flex-wrap w-full">
                <div class="relative text-[#797979] w-full md:w-auto">
                    <input wire:input.debounce.300ms="$set('search', $event.target.value)" type="text"
                        placeholder="Search user..."
                        class="w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
                <div class="relative text-[#797979] flex-1 md:flex-none">
                    <select wire:change="$set('selectedRole', $event.target.value)"
                        class="w-full md:w-[180px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                        <option value="all">All Roles</option>
                        <option value="admin_officer">Admin Officer</option>
                        <option value="cashier">Cashier</option>
                        <option value="technician">Technician</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="relative text-[#797979] flex-1 md:flex-none">
                    <select wire:change="$set('selectedStatus', $event.target.value)"
                        class="w-full md:w-[150px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="revoked">Revoked</option>
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
            <button wire:click="openModal"
                class="hidden whitespace-nowrap cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md md:flex items-center text-white gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="lucide lucide-plus-icon lucide-plus">
                    <path d="M5 12h14" />
                    <path d="M12 5v14" />
                </svg>
                <p class="text-sm">Add New User</p>
            </button>
        </div>
        <div class="w-full overflow-x-auto">
            <div class="min-w-[800px] md:w-full flex flex-col font-inter">
                <div class="rounded-t-3xl bg-[#EEF2F5] w-full flex items-center text-center p-3">
                    <div class="w-[40%] text-start pl-1">Name</div>
                    <div class="w-[15%]">Role</div>
                    <div class="w-[15%]">Status</div>
                    <div class="w-[15%]">Joined At</div>
                    <div class="w-[15%]">Action</div>
                </div>
                <div class="w-full flex flex-col text-center bg-white">
                    @forelse ($users as $user)
                        <div class="w-full flex items-center text-sm border-x border-b border-[#EEF2F5] text-[#484848]">
                            <div class="w-[40%] text-start capitalize px-1 pl-3 py-4">{{ $user->fullname }}</div>
                            @php
                                $role = match ($user->role) {
                                    'admin_officer' => 'Admin Officer',
                                    'cashier' => 'Cashier',
                                    'technician' => 'Technician',
                                };
                            @endphp
                            <div class="w-[15%] py-4">{{ $role }}</div>
                            <div class="w-[15%] capitalize py-4 {{ $user->status == 'revoked' ? 'text-red-600' : 'text-[#16A34A]' }}">
                                {{ $user->status }}</div>
                            <div class="w-[15%] py-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($user->created_at)->format('F d, Y') }}</div>
                            <div class="w-[15%] py-4 flex items-center justify-center">
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="hidden peer"
                                        wire:click="updateStatus({{ $user->id }})" @checked($user->status === 'active')>
                                    <div
                                        class="relative w-10 h-5 bg-gray-400 rounded-full peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4.5 after:transition-all peer-checked:bg-black">
                                    </div>
                                </label>
                            </div>
                        </div>
                    @empty
                        <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                            No Staff found.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2">
            <p class="">Showing {{ $users->firstItem() ?? 0 }} to {{ $users->lastItem() }} of
                {{ $users->total() }}
                entries</p>
            <nav>
                <div class="flex items-center -space-x-px h-8">
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        @if ($users->onFirstPage()) disabled @endif
                        class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </button>
                    @foreach (range(1, $users->lastPage()) as $page)
                        <div wire:click="gotoPage({{ $page }})"
                            class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $users->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                            {{ $page }}
                        </div>
                    @endforeach
                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        @if (!$users->hasMorePages()) disabled @endif
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

    <button wire:click="openModal"
        class="fixed md:hidden bottom-6 right-6 z-20 bg-[#203D3F] hover:bg-[#14505c] text-white rounded-full shadow-lg flex items-center justify-center p-4 transition-all duration-200"
        style="box-shadow: 0 4px 16px rgba(32,61,63,0.15);">
        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="lucide lucide-plus-icon lucide-plus">
            <path d="M5 12h14" />
            <path d="M12 5v14" />
        </svg>
    </button>

    @if ($showModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[300px] md:max-w-md gap-2 w-full p-6 md:p-8 relative flex flex-col font-poppins">
                <h1 class="font-bold text-lg">Register Staff</h1>
                <livewire:user-form />
            </div>
        </div>
    @endif
</div>
