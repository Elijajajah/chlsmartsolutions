@php
    $orderId = session('orderId');
    $order = $orderId ? \App\Models\Order::with('productSerials.product')->find($orderId) : null;
@endphp

<div>
    @if ($order)
        <div x-data="{
            show: {{ session('showCard') ? 'true' : 'false' }},
            saving: false
        }" x-init="if (show && !{{ session('receipt_saved') ? 'true' : 'false' }}) {
            saving = true;
            $nextTick(() => autoSaveReceipt());
        }" x-on:receipt-saved.window="saving = false" x-show="show"
            x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-xs">
            <div x-show="saving" class="absolute inset-0 flex items-center justify-center bg-white/80 z-50 rounded-xl">
                <svg class="animate-spin h-10 w-10 text-green-600" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 00-8 8z" />
                </svg>
                <p class="ml-3 text-sm font-medium">Saving receipt…</p>
            </div>
            <div id="capture-area"
                class="bg-white flex flex-col rounded-xl font-inter p-8 gap-4 w-[320px] md:w-[450px]">
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
                    <p class="font-bold mb-2 text-xs md:text-base">Sales Invoice</p>
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
                        @if ($order && $order->productSerials->isNotEmpty())
                            @php
                                $groupedProducts = $order->productSerials->groupBy('product_id');
                            @endphp

                            @foreach ($groupedProducts as $productId => $serials)
                                @php
                                    $product = $serials->first()->product;
                                    $quantity = $serials->count();
                                    $total = $quantity * $product->retail_price;
                                @endphp

                                <div class="flex items-center w-full">
                                    <div class="w-[50%] line-clamp-1">{{ ucwords($product->name) }}</div>
                                    <div class="w-[15%] text-center">x{{ $quantity }}</div>
                                    <div class="w-[35%] text-center">
                                        ₱{{ number_format($total, 2) }}
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                    <hr class="w-full h-px border-[#BBBBBB] mt-4">
                    @if (session('tax') > 0)
                        <div class="w-full flex items-center justify-between">
                            <p class="font-semibold text-sm">Tax:</p>
                            <p class="w-[35%] text-center font-medium">{{ session('tax') }}%</p>
                        </div>
                    @endif
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
                    <button wire:click="downloadReceipt" class="bg-[#5AA526] py-2 px-4 rounded-md cursor-pointer">
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
    async function autoSaveReceipt() {
        const original = document.getElementById('capture-area');
        const cloneContainer = document.getElementById('clone-container');

        const clone = original.cloneNode(true);
        clone.classList.add('dom-capture');

        const exclude = clone.querySelector('#exclude');
        if (exclude) exclude.remove();

        const scroll = clone.querySelector('#receipt-scroll');
        if (scroll) {
            scroll.style.maxHeight = 'none';
            scroll.style.overflow = 'visible';
        }

        cloneContainer.innerHTML = '';
        cloneContainer.appendChild(clone);

        await document.fonts.ready;
        await waitForImages(clone);

        try {
            const dataUrl = await domtoimage.toPng(clone, {
                bgcolor: '#ffffff',
                width: clone.offsetWidth,
                height: clone.scrollHeight,
                cacheBust: true
            });

            // 🔥 Send to Livewire
            Livewire.dispatch('save-receipt', {
                image: dataUrl
            });

        } catch (err) {
            console.error(err);
        }
    }

    function waitForImages(container) {
        const images = container.querySelectorAll('img');

        return Promise.all(
            [...images].map(img => {
                if (img.complete && img.naturalWidth !== 0) {
                    return Promise.resolve();
                }

                return new Promise(resolve => {
                    img.onload = img.onerror = resolve;
                });
            })
        );
    }
</script>
