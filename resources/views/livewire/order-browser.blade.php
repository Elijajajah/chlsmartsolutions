<div class="flex flex-col gap-4 md:gap-6">
    <div class="flex flex-col md:flex-row items-center justify-between font-poppins gap-2 md:gap-4">
        <div
            class="w-full md:w-[23.5%] gap-2 flex items-center justify-between bg-white rounded-lg py-2 px-4 md:py-4 md:px-6 border-l-6 border-blue-600">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-blue-600">
                    <path
                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625Z" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Total Order</p>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold">{{ $this->getOrder() }}</h1>
        </div>
        <div
            class="w-full md:w-[23.5%] gap-2 flex items-center justify-between bg-white rounded-lg py-2 px-4 md:py-4 md:px-6 border-l-6 border-[#F97316]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#F97316]">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z"
                        clip-rule="evenodd" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="md:text-[0.6rem]">Today</p>
                    <p class="text-sm font-medium">Pending Order</p>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold">{{ $this->getOrder('pending') }}</h1>
        </div>
        <div
            class="w-full md:w-[23.5%] gap-2 flex items-center justify-between bg-white rounded-lg py-2 px-4 md:py-4 md:px-6 border-l-6 border-[#22C55E]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#22C55E]">
                    <path fill-rule="evenodd"
                        d="M9 1.5H5.625c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5Zm6.61 10.936a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 14.47a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                        clip-rule="evenodd" />
                    <path
                        d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Today</p>
                    <p class="text-sm font-medium">Resolved Order</p>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold">{{ $this->getOrder('completed') }}</h1>
        </div>
        <div
            class="w-full md:w-[23.5%] gap-2 flex items-center justify-between bg-white rounded-lg py-2 px-4 md:py-4 md:px-6 border-l-6 border-[#DC2626]">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="size-9 text-[#DC2626]">
                    <path fill-rule="evenodd"
                        d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875ZM9.75 14.25a.75.75 0 0 0 0 1.5H15a.75.75 0 0 0 0-1.5H9.75Z"
                        clip-rule="evenodd" />
                    <path
                        d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                </svg>
                <div class="flex flex-col">
                    <p class="text-[0.6rem]">Overall</p>
                    <p class="text-sm font-medium">Expired Order</p>
                </div>
            </div>
            <h1 class="text-2xl font-extrabold">{{ $this->getOrder('expired') }}</h1>
        </div>
    </div>
    <div class="flex flex-col gap-4 bg-white rounded-2xl p-4 mb-4 md:mb-0">
        @if ($activeTab === 'orderBrowse')
            <div class="flex flex-col md:flex-row-reverse items-end md:items-center justify-between gap-2">
                <button wire:click="$set('activeTab', 'addOrder')"
                    class="cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md flex items-center text-white gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-plus-icon lucide-plus">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    <p class="text-sm">Add New Order</p>
                </button>
                <div class="flex items-center gap-2 md:gap-6">
                    <div class="relative text-[#797979]">
                        <input type="text" placeholder="Search order..."
                            wire:input.debounce.300ms="$set('search', $event.target.value)"
                            class="w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />

                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                    </div>

                    <div class="relative text-[#797979]">
                        <select wire:change="$set('selectedStatus', $event.target.value)"
                            class="w-[150px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                            name="status" id="status">
                            <option value="0">All Status</option>
                            <option value="1">Pending</option>
                            <option value="2">Completed</option>
                            <option value="3">Expired</option>
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
            </div>
            <div class="w-full overflow-x-auto">
                <div class="min-w-[1010px] flex flex-col font-inter">
                    <div class="rounded-t-3xl bg-[#EEF2F5] w-full flex items-center text-center p-3">
                        <div class="w-[10%]"></div>
                        <div class="w-[30%] text-start pl-1">Reference Id</div>
                        <div class="w-[25%]">Total Amount</div>
                        <div class="w-[20%]">Status</div>
                        <div class="w-[15%]">Actions</div>
                    </div>
                    <div class="w-full flex flex-col text-center bg-white">
                        @forelse ($orders as $order)
                            <div class="w-full flex items-center border-x border-b border-[#EEF2F5] text-[#484848]">
                                <div class="w-[10%] pl-3 py-4">{{ $order->id }}</div>
                                <div class="w-[30%] text-start pl-3 border-x border-[#EEF2F5] py-4">
                                    {{ $order->reference_id }}</div>
                                <div class="w-[25%] py-4">₱{{ number_format($order->total_amount, 2) }}</div>
                                <div
                                    class="w-[20%] pr-1 border-x border-[#EEF2F5] py-3 flex items-center justify-center">
                                    @if ($order->status == 'pending')
                                        <div
                                            class="bg-[#ffeaba] py-2 px-4 w-fit rounded-full text-[#c77a0e] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $order->status }}</p>
                                        </div>
                                    @elseif ($order->status == 'completed')
                                        <div
                                            class="bg-[#c1eacad7] py-2 px-4 w-fit rounded-full text-[#16A34A] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-check-icon lucide-check">
                                                <path d="M20 6 9 17l-5-5" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $order->status }}</p>
                                        </div>
                                    @else
                                        <div
                                            class="bg-[#dc262633] py-2 px-4 w-fit rounded-full text-[#DC2626] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-x-icon lucide-x">
                                                <path d="M18 6 6 18" />
                                                <path d="m6 6 12 12" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $order->status }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="w-[15%] pr-4 py-3 flex items-center justify-center gap-2 text-xs">
                                    <button wire:click='selectOrder({{ $order->id }})'
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
                                </div>
                            </div>
                        @empty
                            <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                                No Order found.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-2">
                <p class="">Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() }} of
                    {{ $orders->total() }}
                    entries</p>
                <nav>
                    <div class="flex items-center -space-x-px h-8">
                        <button wire:click="previousPage" wire:loading.attr="disabled"
                            @if ($orders->onFirstPage()) disabled @endif
                            class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                            <span class="sr-only">Previous</span>
                            <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                        </button>

                        @foreach (range(1, $orders->lastPage()) as $page)
                            <div wire:click="gotoPage({{ $page }})"
                                class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $orders->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                                {{ $page }}
                            </div>
                        @endforeach


                        <button wire:click="nextPage" wire:loading.attr="disabled"
                            @if (!$orders->hasMorePages()) disabled @endif
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
            @if ($showModal && $selectedOrder)
                <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
                    <div
                        class="bg-white rounded-xl shadow-lg max-w-[280px] md:max-w-lg gap-6 w-full p-8 relative font-inter flex flex-col items-center justify-center">
                        <div class="flex flex-col w-full gap-4 font-poppins">
                            <div class="flex w-full items-center justify-between">
                                <div class="flex flex-col">
                                    <h1 class="font-semibold text-xl mb-2">Order Details</h1>
                                    <p class="text-sm">Order #:
                                        {{ str_pad($selectedOrder->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <p class="text-sm">Reference Id#: {{ $selectedOrder->reference_id }}</p>
                                </div>
                                <div>
                                    @if ($selectedOrder->status == 'pending')
                                        <div
                                            class="bg-[#ffeaba] py-2 px-4 w-fit rounded-full text-[#c77a0e] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-ellipsis-icon lucide-ellipsis">
                                                <circle cx="12" cy="12" r="1" />
                                                <circle cx="19" cy="12" r="1" />
                                                <circle cx="5" cy="12" r="1" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $selectedOrder->status }}</p>
                                        </div>
                                    @elseif ($selectedOrder->status == 'completed')
                                        <div
                                            class="bg-[#c1eacad7] py-2 px-4 w-fit rounded-full text-[#16A34A] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-check-icon lucide-check">
                                                <path d="M20 6 9 17l-5-5" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $selectedOrder->status }}</p>
                                        </div>
                                    @else
                                        <div
                                            class="bg-[#dc262633] py-2 px-4 w-fit rounded-full text-[#DC2626] flex gap-1 items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="lucide lucide-x-icon lucide-x">
                                                <path d="M18 6 6 18" />
                                                <path d="m6 6 12 12" />
                                            </svg>
                                            <p class="text-xs capitalize">{{ $selectedOrder->status }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2 w-full">
                            <h1 class="font-medium">Order items({{ count($selectedOrder->orderProducts) }})</h1>
                            <div class="flex items-center text-center text-xs text-[#747474]">
                                <div class="w-[50%]">ITEMS</div>
                                <div class="w-[15%]">QTY</div>
                                <div class="w-[35%]">PRICE</div>
                            </div>
                            <div
                                class="flex flex-col items-center max-h-[150px] overflow-hidden overflow-y-auto custom-scrollbar">
                                @foreach ($selectedOrder->orderProducts as $order)
                                    <div class="flex items-center w-full">
                                        <div class="w-[50%]">{{ $order->product->name }}</div>
                                        <div class="w-[15%] text-center">x{{ $order->quantity }}</div>
                                        <div class="w-[35%] text-center">
                                            ₱{{ number_format($order->product->price * $order->quantity, 2) }}</div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="w-full h-px border-[#BBBBBB] mt-4">
                            <div class="w-full flex items-center justify-between">
                                <p class="font-bold">Total:</p>
                                <p class="w-[35%] text-center">₱{{ number_format($selectedOrder->total_amount, 2) }}
                                </p>
                            </div>
                        </div>



                        <div class="flex items-center justify-center w-full gap-4 mt-6">
                            <button wire:click='updateStatus({{ $selectedOrder->id }})'
                                class="cursor-pointer flex gap-2 items-center py-2 px-4 bg-[#16A34A] rounded-md text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-circle-check-big-icon lucide-circle-check-big">
                                    <path d="M21.801 10A10 10 0 1 1 17 3.335" />
                                    <path d="m9 11 3 3L22 4" />
                                </svg>
                                <p>Mark as Complete</p>
                            </button>
                            <button wire:click='closeModal'
                                class="cursor-pointer flex gap-2 items-center py-2 px-4 bg-red-500 rounded-md text-white">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        @if ($activeTab === 'addOrder')
            <div class="flex flex-col gap-6 md:gap-10">
                <div class="flex flex-col gap-4">
                    <div class="flex items-center gap-4">
                        <button wire:click="$set('activeTab', 'orderBrowse')" class="cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-undo2-icon lucide-undo-2">
                                <path d="M9 14 4 9l5-5" />
                                <path d="M4 9h10.5a5.5 5.5 0 0 1 5.5 5.5a5.5 5.5 0 0 1-5.5 5.5H11" />
                            </svg>
                        </button>
                        <h1 class="font-poppins font-semibold text-lg">Purchase Information</h1>
                    </div>
                    <div class="flex flex-col md:flex-row gap-2 md:items-center font-inter md:gap-6">
                        <div class="flex flex-col text-[#797979] gap-1">
                            <p class="text-sm font-medium">Customer Type</p>
                            <form action="/order" method="POST" id="form" class="relative">
                                @csrf
                                <input type="text" class="hidden" name="total_amount" id="total_amount">
                                <input type="text" class="hidden" name="payment_method" id="payment_method">
                                <select wire:change="$set('type', $event.target.value)"
                                    class="w-full md:w-[250px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                                    name="type" id="type">
                                    <option selected disabled>Select a type</option>
                                    <option value="walk_in">Walk-in</option>
                                    <option value="project_based">Project-based</option>
                                    <option value="government">Government</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </form>
                        </div>
                        <div class="flex flex-col text-[#797979] gap-1">
                            <p class="text-sm font-medium">Current Date</p>
                            <div class="flex items-center relative text-[#797979]">
                                <input type="date" disabled value="{{ now()->format('Y-m-d') }}"
                                    class="w-full md:w-[250px] pr-10 pl-4 py-2 border border-gray-500 rounded-md focus:outline-none" />
                                <svg class="absolute top-2 right-4" xmlns="http://www.w3.org/2000/svg" width="23"
                                    height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-calendar-check-icon lucide-calendar-check">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                    <path d="m9 16 2 2 4-4" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex flex-col md:flex-row md:items-center gap-4 justify-between">
                        <h1 class="font-poppins font-semibold text-lg">Create New Order</h1>
                        <livewire:product-search />
                    </div>

                    <livewire:order-list />

                    <div class="flex items-start justify-end w-full">
                        <button wire:click="goToCheckout"
                            class="bg-[#2563EB] text-white rounded-md px-4 py-2 flex items-center gap-2 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-check-icon lucide-check">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                            <p>Create Order</p>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <livewire:receipt />
    </div>
</div>
