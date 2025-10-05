<div class="w-full flex flex-col gap-4">
    <div class="w-full flex justify-between items-center mb-4">
        <h1 class="font-bold font-poppins text-xl md:text-2xl">Orders</h1>
        <button id="profile-button"
            class="hidden rounded-full w-8 h-8 md:flex items-center justify-between overflow-hidden cursor-pointer">
            <img src="{{ asset('images/profile.png') }}" alt="profile.png">
        </button>
    </div>

    <livewire:order-browser />
</div>
