<div class="bg-[#203D3F] w-full md:w-[22%] md:rounded-md font-poppins md:h-[calc(100vh-1rem)] md:sticky md:top-2 z-50">
    <div class="hidden md:flex flex-col">
        <div class="py-10 text-white flex justify-center items-center gap-2">
            <img src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo" class="w-7">
            <h1 class="font-semibold">
                CHL SmartSolutions
            </h1>
        </div>
        <div class="flex flex-col text-white font-medium tracking-widest gap-2">
            @foreach ($items as $item)
                <div class="relative px-12 py-2">
                    @if ($active === $item['label'])
                        <div class="absolute left-0 top-0 w-18 h-full border-l-6 border-[#50FF7F]"></div>
                    @endif

                    @if ($item['label'] == 'notification' && $unreadNotif > 0)
                        <div wire:poll.3s
                            class="absolute left-15 top-1 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                            {{ $unreadNotif }}
                        </div>
                    @endif

                    <button
                        class="flex items-center gap-5 cursor-pointer {{ $active === $item['label'] ? 'text-[#50FF7F]' : 'text-white' }}"
                        wire:loading.attr="disabled" wire:target="setActive"
                        wire:click="setActive('{{ $item['label'] }}')">
                        {!! $item['icon'] !!}
                        <p class="capitalize text-xs">{{ $item['label'] }}</p>
                    </button>
                </div>
            @endforeach

            <hr class="border-[#A7A7A7] my-2 mx-4">
            <button class="relative px-12 py-2">
                <div class="flex items-center gap-5 text-white cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings">
                        <path
                            d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>
                    <p class="text-xs">Setting</p>
                </div>
            </button>

            <div class="relative px-12 py-2">
                <form method="POST" action="/signout">
                    @csrf
                    <button type="submit" class="cursor-pointer flex items-center gap-5 'text-white'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-log-out-icon lucide-log-out">
                            <path d="m16 17 5-5-5-5" />
                            <path d="M21 12H9" />
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        </svg>
                        <p class="text-xs">Sign out</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="flex md:hidden items-center justify-between text-white p-4">
        <div class="flex justify-center items-center gap-2">
            <img src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo" class="w-7">
            <h1 class="font-semibold">
                CHL SmartSolutions
            </h1>
        </div>
        <div class="drawer drawer-end flex justify-end w-fit">
            <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <label for="my-drawer-4" class="cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-menu-icon lucide-menu">
                        <path d="M4 12h16" />
                        <path d="M4 18h16" />
                        <path d="M4 6h16" />
                    </svg>
                </label>
            </div>

            <div class="drawer-side">
                <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
                <ul
                    class="menu bg-[#203D3F] flex flex-col text-white font-medium tracking-widest gap-2 min-h-screen w-58 p-4">
                    <div class="mt-2 py-4 text-white flex flex-col justify-center items-center text-center px-6 gap-2">
                        <img src="{{ asset('images/profile.png') }}" alt="profile" class="w-12 rounded-full">
                        <h1 class="font-semibold mt-1 text-xs">{{ ucfirst(auth()->user()->fullname) }}</h1>
                        @php
                            $user = auth()->user();
                            $role = match ($user->role) {
                                'admin' => 'Admin',
                                'admin_officer' => 'Admin Officer',
                                'cashier' => 'Cashier',
                                'technician' => match ($user->technicianRole->role ?? null) {
                                    'main' => 'Main Technician',
                                    'support' => 'Support Technician',
                                    default => 'Technician',
                                },
                            };
                        @endphp
                        <p class="text-[0.5rem] font-light -mt-1">{{ $role }}</p>
                    </div>
                    @foreach ($items as $item)
                        <div class="relative px-6 py-1.5">

                            @if ($item['label'] == 'notification' && $unreadNotif > 0)
                                <div wire:poll.3s
                                    class="absolute left-9 md:left-15 top-0 md:top-1 bg-red-500 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full">
                                    {{ $unreadNotif }}
                                </div>
                            @endif

                            <button
                                class="flex items-center gap-5 cursor-pointer {{ $active === $item['label'] ? 'text-[#50FF7F]' : 'text-white' }}"
                                wire:loading.attr="disabled" wire:target="setActive"
                                wire:click="setActive('{{ $item['label'] }}')">
                                {!! $item['icon'] !!}
                                <p class="capitalize text-xs">{{ $item['label'] }}</p>
                            </button>
                        </div>
                    @endforeach
                    <hr class="border-[#A7A7A7] my-3 mx-2">
                    <button class="relative px-6 py-1.5">
                        <div class="flex items-center gap-5 text-white cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="lucide lucide-settings-icon lucide-settings">
                                <path
                                    d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <p class="text-xs">Setting</p>
                        </div>
                    </button>

                    <div class="relative px-6 py-1.5">
                        <form method="POST" action="/signout">
                            @csrf
                            <button type="submit" class="cursor-pointer flex items-center gap-5 'text-white'">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="lucide lucide-log-out-icon lucide-log-out">
                                    <path d="m16 17 5-5-5-5" />
                                    <path d="M21 12H9" />
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                </svg>
                                <p class="text-xs">Sign out</p>
                            </button>
                        </form>
                    </div>
                </ul>
            </div>
        </div>

    </div>
</div>
