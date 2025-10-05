<div class="flex flex-col gap-6">
    <div class="w-full flex items-center justify-end gap-4">
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
        <button wire:click="exportSales"
            class="cursor-pointer px-4 py-2 bg-[#203D3F] rounded-md text-white text-sm gap-2 whitespace-nowrap">
            Download Report
        </button>
    </div>
    <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
        <div
            class="flex items-center bg-[#3B82F60F] text-[#3B82F6] border-l-6 border-[#3B82F6] w-[47.5%] md:w-1/4 px-4 py-2 gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                <path
                    d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
            </svg>
            <div class="flex flex-col font-poppins">
                <p class=" text-xs">Online Sales</p>
                <h1 class="text-[#1E3A8A] font-bold text-base">₱{{ number_format($this->getSales('online'), 2) }}</h1>
                <p class="text-[0.6rem]">{{ $this->getTransaction('online') }} transactions</p>
            </div>
        </div>
        <div
            class="flex items-center bg-[#16A34A0F] text-[#22C55E] border-l-6 border-[#22C55E] w-[47.5%] md:w-1/4 px-4 py-2 gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                <path
                    d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
            </svg>
            <div class="flex flex-col font-poppins">
                <p class=" text-xs">Walk-in Sales</p>
                <h1 class="text-[#14532D] font-bold text-base">₱{{ number_format($this->getSales('walk_in'), 2) }}</h1>
                <p class="text-[0.6rem]">{{ $this->getTransaction('walk_in') }} transactions</p>
            </div>
        </div>
        <div
            class="flex items-center bg-[#A855F70F] text-[#A852EE] border-l-6 border-[#A852EE] w-[47.5%] md:w-1/4 px-4 py-2 gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                <path
                    d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
            </svg>
            <div class="flex flex-col font-poppins">
                <p class=" text-xs">Government Sales</p>
                <h1 class="text-[#581C87] font-bold text-base">₱{{ number_format($this->getSales('government'), 2) }}
                </h1>
                <p class="text-[0.6rem]">{{ $this->getTransaction('government') }} transactions</p>
            </div>
        </div>
        <div
            class="flex items-center bg-[#F973160F] text-[#F97316] border-l-6 border-[#F97316] w-[47.5%] md:w-1/4 px-4 py-2 gap-4">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-10">
                <path
                    d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
            </svg>
            <div class="flex flex-col font-poppins">
                <p class=" text-xs">Project Sales</p>
                <h1 class="text-[#7C2D12] font-bold text-base">₱{{ number_format($this->getSales('project_based'), 2) }}
                </h1>
                <p class="text-[0.6rem]">{{ $this->getTransaction('project_based') }} transactions</p>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-4 md:gap-2 bg-white rounded-md mb-4 md:mb-0">
        <div class="flex flex-col md:flex-row md:items-center justify-between p-4 gap-4">
            <div class="flex font-poppins flex-col">
                <h1 class="text-lg font-medium">Sales Record</h1>
                <p class="text-xs text-[#B8B8B8]">Complete record of all sales transactions</p>
            </div>
            <div class="flex flex-wrap items-baseline gap-4">
                <div class="relative text-[#797979]">
                    <select wire:change="$set('selectedType', $event.target.value)"
                        class="w-full md:w-[180px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                        name="customer_type" id="customer_type">
                        <option value="all">All Type</option>
                        <option value="online">Online</option>
                        <option value="walk_in">Walk-in</option>
                        <option value="government">Government</option>
                        <option value="project_based">Project-Based</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-2 flex items-center">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="relative text-[#797979]">
                    <select wire:change="$set('selectedCategory', $event.target.value)"
                        class="w-[200px] md:w-[280px] px-4 py-2 border border-gray-500 rounded-md focus:outline-none appearance-none"
                        name="category" id="category">
                        <option value="0">All Category</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
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
                <div class="relative text-[#797979] w-full md:w-[230px]">
                    <input type="text" wire:input.debounce.300ms="$set('search', $event.target.value)"
                        placeholder="Search product..."
                        class="w-full pr-10 pl-4 py-2  border border-gray-500 rounded-md focus:outline-none" />

                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <div class="min-w-[1024px] flex flex-col font-inter">
                <div class="flex items-center bg-[#F9FAFB] text-sm text-[#878787] p-4 border-y border-[#E5E7EB]">
                    <div class="w-[15%]">CUSTOMER TYPE</div>
                    <div class="w-[15%]">SERIAL NUMBER</div>
                    <div class="w-[22%]">PRODUCT NAME</div>
                    <div class="w-[18%] text-center">CATEGORY</div>
                    <div class="w-[10%] text-center">QUANTITY</div>
                    <div class="w-[20%] text-center">AMOUNT</div>
                </div>
                @forelse ($products as $product)
                    @php
                        $type = 'N\A';
                        $quantity = 0;
                        $total = 0;

                        $grouped = $product->orderProducts
                            ->groupBy(function ($orderProduct) {
                                return $orderProduct->order->type;
                            })
                            ->map(function ($group) {
                                return $group->sum('quantity');
                            })
                            ->sortDesc();

                        if ($grouped->isNotEmpty()) {
                            $type = $grouped->keys()->first();
                            $quantity = $grouped->first();
                            $total = $quantity * $product->price;
                        }
                    @endphp

                    <div class="flex items-center text-sm text-[#484848] p-4 border-b border-[#E5E7EB]">
                        <div class="w-[15%] flex items-center justify-start">
                            @if ($type == 'online')
                                <div class="bg-[#3B82F6] text-white py-2 px-4 rounded-md text-xs">Online</div>
                            @elseif ($type == 'walk_in')
                                <div class="bg-[#22C55E] text-white py-2 px-4 rounded-md text-xs">Walk-in</div>
                            @elseif ($type == 'government')
                                <div class="bg-[#A852EE] text-white py-2 px-4 rounded-md text-xs">Government</div>
                            @elseif ($type == 'project_based')
                                <div class="bg-[#F97316] text-white py-2 px-4 rounded-md text-xs">Project-Based</div>
                            @else
                                <div class="bg-[#b8b8b8] text-white py-2 px-4 rounded-md text-xs">N/A</div>
                            @endif
                        </div>
                        <div class="w-[15%] capitalize">{{ $product->serial_number }}</div>
                        <div class="w-[22%] capitalize">{{ $product->name }}</div>
                        <div class="w-[18%] text-center capitalize">{{ $product->category->name }}</div>
                        <div class="w-[10%] text-center">x{{ $quantity }}</div>
                        <div class="w-[20%] text-center font-semibold text-black">
                            ₱{{ number_format($total, 2) }}</div>
                    </div>
                @empty
                    <div class="w-full py-8 flex items-center justify-center text-sm text-[#9A9A9A]">
                        No Sales found.
                    </div>
                @endforelse
            </div>
        </div>
        <div class="w-full flex flex-col md:flex-row gap-2 items-center justify-between h-fit p-4">
            <p class="">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() }} of
                {{ $products->total() }}
                entries</p>
            <nav>
                <div class="flex items-center -space-x-px h-8">
                    <button wire:click="previousPage" wire:loading.attr="disabled"
                        @if ($products->onFirstPage()) disabled @endif
                        class="text-gray-500 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center justify-center px-3 h-8 ms-0 leading-tight bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700">
                        <span class="sr-only">Previous</span>
                        <svg class="w-3.5 h-3.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="M5 1 1 5l4 4" />
                        </svg>
                    </button>

                    @foreach (range(1, $products->lastPage()) as $page)
                        <div wire:click="gotoPage({{ $page }})"
                            class="flex items-center justify-center px-3 h-8 leading-tight
                                    {{ $products->currentPage() === $page
                                        ? 'text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700'
                                        : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer' }}">
                            {{ $page }}
                        </div>
                    @endforeach


                    <button wire:click="nextPage" wire:loading.attr="disabled"
                        @if (!$products->hasMorePages()) disabled @endif
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

</div>
