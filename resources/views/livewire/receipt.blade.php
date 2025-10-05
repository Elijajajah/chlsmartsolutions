@php
    $order = \App\Models\Order::with('orderProducts.product')->find(session('orderId'));
@endphp

<div>
    @if ($order)
        <div x-data="{ show: {{ session('showCard') ? 'true' : 'false' }} }" x-show="show" x-transition x-cloak
            class="fixed inset-0 z-50 flex flex-col items-center justify-center bg-black/50 backdrop-blur-xs">
            <div id="capture-area" class="bg-white flex flex-col rounded-xl font-inter p-8 gap-4 w-[320px] md:w-[450px]">
                <div class="flex flex-col items-center justify-center gap-1">
                    <div class="flex items-center gap-2">
                        <img class="w-6 md:w-8" src="{{ asset('images/chlss_logo.png') }}" alt="chlss_logo.png"
                            crossorigin="anonymous">
                        <p class="font-bold text-xs md:text-base whitespace-nowrap">CHL Distri&IT Solutions</p>
                    </div>
                    <div class="flex flex-col items-center text-center">
                        <p class="text-[#747474] text-[0.6rem] md:text-[0.7rem]">2nd flr. Vanessa Olga Building,
                            Malusak, Boac,
                            Marinduque
                        </p>
                        <p class="text-[#747474] text-[0.6rem] md:text-[0.7rem]">(+63) 9992264818 |
                            chldisty888@gmail.com</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="font-bold mb-2 text-xs md:text-base">Sales Receipt</p>
                    <div class="flex items-center justify-between text-[0.7rem] md:text-sm">
                        <p>Reference #: <span class="text-[#747474]">{{ session('referenceId') }}</span></p>
                        <p>Order #:<span class="text-[#747474]">{{ session('orderId') }}</span></p>
                    </div>
                    <p class="text-[0.7rem] md:text-sm">Date: <span
                            class="text-[#747474]">{{ now()->format('F j, Y') }}</span>
                    </p>
                    <hr class="w-full h-px border-[#BBBBBB] mt-4">
                </div>
                <div class="flex flex-col text-[0.7rem] md:text-sm gap-2">
                    <div class="flex items-center text-center text-[#747474]">
                        <div class="w-[50%]">PRODUCTS</div>
                        <div class="w-[15%]">QTY</div>
                        <div class="w-[35%]">PRICE</div>
                    </div>
                    <div id="receipt-scroll"
                        class="flex flex-col items-center max-h-[100px] overflow-hidden overflow-y-auto custom-scrollbar">
                        @foreach ($order->orderProducts as $item)
                            <div class="flex items-center w-full">
                                <div class="w-[50%] line-clamp-1">{{ ucwords($item->product->name) }}</div>
                                <div class="w-[15%] text-center">x{{ $item->quantity }}</div>
                                <div class="w-[35%] text-center">
                                    ₱{{ number_format($item->quantity * $item->product->price, 2) }}</div>
                            </div>
                        @endforeach

                    </div>
                    <hr class="w-full h-px border-[#BBBBBB] mt-4">
                    <div class="w-full flex items-center justify-between">
                        <p class="font-bold">Total:</p>
                        <p class="w-[35%] text-center font-medium">₱{{ number_format(session('total'), 2) }}</p>
                    </div>
                </div>
                <div class="w-full flex flex-col items-center justify-center text-center text-[#747474]">
                    <p class="text-[#747474] text-[0.6rem] md:text-[0.7rem]">Thank you for choosing our services!
                    </p>
                    <p class="text-[#747474] text-[0.6rem] md:text-[0.7rem]">For support, contact us at
                        chldisty888@gmail.com</p>
                </div>
                <div id="exclude"
                    class="w-full flex items-center justify-center text-white mt-4 gap-8 text-xs md:text-sm bg-white p-2 rounded-lg">
                    <button onclick="downloadAsImage()" class="bg-[#5AA526] py-2 px-4 rounded-md cursor-pointer">
                        Download
                    </button>
                    <button wire:click="clearSession" @click="show = false"
                        class="bg-black py-2 px-4 rounded-md cursor-pointer">Close</button>
                </div>
            </div>
            <div id="clone-container" style="position: absolute; top: -9999px; left: -9999px;"></div>
        </div>
    @endif
</div>

<script>
    function downloadAsImage() {
        const node = document.getElementById('capture-area');
        const scrollable = document.getElementById('receipt-scroll');
        const cloneContainer = document.getElementById('clone-container');

        // Clone node
        const clone = node.cloneNode(true);
        const cloneScrollable = clone.querySelector('#receipt-scroll');

        // Show full scroll content
        cloneScrollable.style.maxHeight = 'none';
        cloneScrollable.style.overflow = 'visible';

        // Hide buttons
        const exclude = clone.querySelector('#exclude');
        if (exclude) {
            exclude.remove(); // Remove from DOM to avoid rendering
        }

        // Put clone in hidden container
        cloneContainer.innerHTML = '';
        cloneContainer.appendChild(clone);

        // Ensure DOM is updated
        setTimeout(() => {
            domtoimage.toPng(clone)
                .then((dataUrl) => {
                    const link = document.createElement('a');
                    link.download = `receipt_{{ session('referenceId') }}.png`;
                    link.href = dataUrl;
                    link.click();
                })
                .catch((error) => {
                    console.error('Error capturing image:', error);
                });
        }, 100); // Reduced delay should work if you're just hiding
    }
</script>
