<div class="max-w-6xl mx-auto px-6 py-14">
    <div class="text-center mb-20">
        <h2 class="text-lg md:text-3xl font-bold">
            What <span class="text-[#5AA526]">SERVICE</span> do you need?
        </h2>
        <p class="text-xs md:text-base text-gray-500 mt-2">
            Select a category to view available services.
        </p>
    </div>

    <!-- Grid Layout -->
    @if (!$showForm)
        <div class="grid md:grid-cols-3 gap-10 mb-12">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-headset size-14" viewBox="0 0 16 16">
                    <path
                        d="M8 1a5 5 0 0 0-5 5v1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V6a6 6 0 1 1 12 0v6a2.5 2.5 0 0 1-2.5 2.5H9.366a1 1 0 0 1-.866.5h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 .866.5H11.5A1.5 1.5 0 0 0 13 12h-1a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h1V6a5 5 0 0 0-5-5" />
                </svg>
                <h2 class="font-semibold text-lg">Technical Support</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('technical support', 'phone support')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Phone Support</h3>
                        <p class="text-sm text-[#B6B6B6]">Regular Checking and Maintenance</p>
                    </button>
                    <button wire:click="selectService('technical support', 'computer maintenance')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Computer Maintenance</h3>
                        <p class="text-sm text-[#B6B6B6]">Regular Checking and Maintenance</p>
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-wrench size-14" viewBox="0 0 16 16">
                    <path
                        d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z" />
                </svg>
                <h2 class="font-semibold text-lg">Maintenance</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('maintenance', 'computer maintenance')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Computer Maintenance</h3>
                        <p class="text-sm text-[#B6B6B6]">Regular Checking and Maintenance</p>
                    </button>
                    <button wire:click="selectService('maintenance', 'software updates')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Software Updates</h3>
                        <p class="text-sm text-[#B6B6B6]">System and Software Updates</p>
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-cloud-download-fill size-14"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 0a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 4.095 0 5.555 0 7.318 0 9.366 1.708 11 3.781 11H7.5V5.5a.5.5 0 0 1 1 0V11h4.188C14.502 11 16 9.57 16 7.773c0-1.636-1.242-2.969-2.834-3.194C12.923 1.999 10.69 0 8 0m-.354 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V11h-1v3.293l-2.146-2.147a.5.5 0 0 0-.708.708z" />
                </svg>
                <h2 class="font-semibold text-lg">Installation</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('installation', 'signal installation')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Signal Installation</h3>
                        <p class="text-sm text-[#B6B6B6]">Satellite Installation</p>
                    </button>
                    <button wire:click="selectService('installation', 'software installation')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Software Installation</h3>
                        <p class="text-sm text-[#B6B6B6]">Installation applications and programs</p>
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-tools size-14" viewBox="0 0 16 16">
                    <path
                        d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z" />
                </svg>
                <h2 class="font-semibold text-lg">Troubleshooting</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('troubleshooting', 'internet issues')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Internet Issues</h3>
                        <p class="text-sm text-[#B6B6B6]">Fix Connection Problems</p>
                    </button>
                    <button wire:click="selectService('troubleshooting', 'slow performance')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Slow Performance</h3>
                        <p class="text-sm text-[#B6B6B6]">Speed up your Device</p>
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-arrow-repeat size-14"
                    viewBox="0 0 16 16">
                    <path
                        d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9" />
                    <path fill-rule="evenodd"
                        d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z" />
                </svg>
                <h2 class="font-semibold text-lg">Device Reset</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('device reset', 'factory reset')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Factory Reset</h3>
                        <p class="text-sm text-[#B6B6B6]">Reset to Factory Setting</p>
                    </button>
                    <button wire:click="selectService('device reset', 'password reset')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Password Reset</h3>
                        <p class="text-sm text-[#B6B6B6]">Reset forgotten Password</p>
                    </button>
                </div>
            </div>
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#2563EB" class="bi bi-book size-14" viewBox="0 0 16 16">
                    <path
                        d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783" />
                </svg>
                <h2 class="font-semibold text-lg">User Guidance</h2>
                <div class="space-y-3 mt-4 w-full">
                    <button wire:click="selectService('user guidance', 'device tutorial')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Device Tutorial</h3>
                        <p class="text-sm text-[#B6B6B6]">Get started with our device</p>
                    </button>
                    <button wire:click="selectService('user guidance', 'software training')"
                        class="text-left w-full border border-[#D6D6D6] rounded-lg p-3 hover:shadow-md cursor-pointer transition bg-[#F6F6F8]">
                        <h3 class="font-medium">Software Training</h3>
                        <p class="text-sm text-[#B6B6B6]">Learn how to use applications</p>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($showForm)
        <div class="w-full flex items-center justify-center p-8 -mt-8">
            <div class="bg-white shadow-lg rounded-2xl p-8 w-full md:w-3/4 lg:w-1/2 space-y-6">
                <!-- Header -->
                <div>
                    <h3 class="text-2xl font-semibold text-[#203D3F]">{{ ucwords($service) }}</h3>
                    <p class="text-gray-600">{{ ucwords($category) }}</p>
                </div>

                <!-- Form Fields -->
                <form class="space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Preferred Date -->
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Preferred Date</label>
                            <div class="relative">
                                <input type="date" type="date" name="date" id="date"
                                    class="hide-calendar w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#203D3F] focus:border-transparent" />
                                <svg onclick="document.getElementById('date').showPicker()"
                                    class="absolute top-3 right-4 cursor-pointer text-gray-600 hover:text-gray-800"
                                    xmlns="http://www.w3.org/2000/svg" width="23" height="23"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M8 2v4" />
                                    <path d="M16 2v4" />
                                    <rect width="18" height="18" x="3" y="4" rx="2" />
                                    <path d="M3 10h18" />
                                    <path d="m9 16 2 2 4-4" />
                                </svg>
                            </div>
                        </div>

                        <!-- Priority -->
                        <div>
                            <label class="block text-sm text-gray-700 mb-1">Priority</label>
                            <div class="relative">
                                <select
                                    class="w-full px-4 py-3 text-gray-700 bg-white border border-gray-300 rounded-md appearance-none focus:outline-none focus:ring-2 focus:ring-[#203D3F] focus:border-transparent">
                                    <option disabled selected value="">Select priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-400">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.23 7.21a.75.75 0 011.06.02L10 10.939l3.71-3.71a.75.75 0 011.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0l-4.24-4.24a.75.75 0 01.02-1.06z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-gray-700 mb-1">Additional details</label>
                        <textarea rows="4" placeholder="Enter your comments or details..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-[#203D3F] focus:border-transparent"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-4 pt-4">
                        <button type="button" wire:click="$set('showForm', false)"
                            class="cursor-pointer w-full px-6 py-3 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-100 transition">Cancel</button>
                        <button type="submit"
                            class="cursor-pointer w-full px-6 py-3 bg-[#203D3F] text-white rounded-md hover:bg-[#1a3133] transition">Submit
                            Request</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
