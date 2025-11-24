<div class="max-w-6xl mx-auto px-6 py-14 mb-4 md:mb-18">
    <div class="text-center mb-4 md:mb-16 mt-2">
        <h2 class="text-3xl font-bold">
            Explore our <span class="text-[#5AA526] italic">services</span>
        </h2>
        <p class="text-sm md:text-base text-gray-500">
            Find the perfect service solution for your needs
        </p>
    </div>

    <div class="flex flex-col justify-center items-center w-full">
        <div
            class="flex flex-col md:flex-row gap-3 md:gap-4 items-center justify-between mb-8 md:mb-16 shadow-lg rounded-2xl p-6 w-full md:w-3/4">
            <!-- Search box -->
            <div class="w-full md:w-[65%]">
                <input type="text" placeholder="Search services by name..." wire:model.live="search"
                    class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#5AA526] focus:ring-[#5AA526] focus:ring-1 outline-none">
            </div>

            <!-- Category dropdown -->
            <div class="w-full md:w-[35%] relative">
                <select wire:model.live='category'
                    class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-[#5AA526] focus:ring-[#5AA526] focus:ring-1 outline-none appearance-none bg-white">
                    <option value="all">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category }}</option>
                    @endforeach
                </select>
                <!-- Dropdown icon -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                </svg>
            </div>
        </div>

        <!-- Service Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 md:gap-y-12 w-full md:px-38">
            @foreach ($categories as $category)
                <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                    <!-- Main Card -->
                    <div class="flex items-center justify-between bg-white rounded-2xl p-4 relative z-10">
                        <div>
                            <h3 class="text-2xl font-semibold">{{ $category->category }}</h3>
                            <p class="text-gray-500 text-sm">{{ $category->services->count() }} services available</p>
                        </div>

                        <!-- Toggle Button -->
                        <button @click="open = !open"
                            class="bg-[#5AA526]/20 text-[#5AA526] cursor-pointer rounded-full w-8 h-8 flex items-center justify-center hover:bg-[#5AA526]/30 transition">
                            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-plus">
                                <path d="M5 12h14" />
                                <path d="M12 5v14" />
                            </svg>
                            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Overlay Below -->
                    <div x-show="open" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0"
                        x-transition:leave-end="opacity-0 translate-y-2"
                        class="absolute left-0 right-0 top-[80%] mt-2 bg-white flex flex-col border border-[#5AA526]/30 rounded-xl p-4 shadow-lg z-50 divide-y divide-gray-200">
                        @foreach ($category->services as $service)
                            <div class="w-full flex items-center justify-between py-3 first:pt-0 last:pb-0">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 flex items-center justify-center rounded-full bg-[#5AA526] text-white text-sm font-semibold">
                                        {{ $loop->iteration }}
                                    </div>

                                    <div>
                                        <h3 class="font-medium text-lg">{{ $service->service }}</h3>
                                    </div>
                                </div>
                                <button wire:click="selectService({{ $category->id }}, {{ $service->id }})"
                                    class="cursor-pointer flex flex-col text-right items-end gap-1 hover:scale-110 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                        viewBox="0 0 24 24" fill="none" stroke="#5AA526" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-move-right">
                                        <path d="M18 8L22 12L18 16" />
                                        <path d="M2 12H22" />
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>

                </div>
            @endforeach
        </div>

        <div class="flex justify-center pt-4 mt-8 md:mt-12">
            <div class="inline-flex items-center space-x-2">
                <button wire:click="previousPage" wire:loading.attr="disabled"
                    @if ($categories->onFirstPage()) disabled @endif
                    class="text-gray-700 pr-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                    <svg width="14" height="18" viewBox="0 0 11 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M10.561 14.7161L0.717773 7.37025L10.561 0.0244141V14.7161Z" fill="#1D1B20" />
                    </svg>
                </button>

                @foreach (range(1, $categories->lastPage()) as $page)
                    <button wire:click="gotoPage({{ $page }})"
                        class="px-4 py-2 shadow-md rounded-xl font-medium
                       {{ $categories->currentPage() === $page ? 'bg-[#5AA526] text-white' : 'bg-white hover:bg-gray-100 text-gray-700 cursor-pointer' }}">
                        {{ $page }}
                    </button>
                @endforeach

                <button wire:click="nextPage" wire:loading.attr="disabled"
                    @if (!$categories->hasMorePages()) disabled @endif
                    class="text-gray-700 pl-2 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer">
                    <svg width="14" height="18" viewBox="0 0 11 15" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.439453 14.7161V0.0244141L10.2826 7.37025L0.439453 14.7161Z" fill="#1D1B20" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if ($selectedService && $selectedCategory)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div
                class="bg-white rounded-xl shadow-lg max-w-[300px] md:max-w-lg gap-2 md:gap-4 w-full p-6 md:p-8 relative font-poppins flex flex-col justify-center">

                <!-- Header -->
                <div>
                    <h3 class="text-2xl font-semibold text-[#203D3F]">{{ ucwords($selectedService->service) }}</h3>
                    <p class="text-gray-600">{{ ucwords($selectedCategory->category) }}</p>
                </div>

                <!-- Form Fields -->
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Additional details</label>
                        <textarea rows="4" placeholder="Enter your comments or details..." wire:model.live="description"
                            class="w-full px-4 py-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-[#203D3F] focus:border-transparent"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4 pt-4">
                        <button type="button" wire:click="closeRequest"
                            class="cursor-pointer w-full px-6 py-3 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition">Cancel</button>
                        <button type="button" wire:click='createRequest'
                            class="cursor-pointer w-full px-6 py-3 bg-[#203D3F] text-white rounded-md hover:bg-[#1a3133] transition">Submit
                            <span class="hidden md:inline">
                                Request</span></button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
