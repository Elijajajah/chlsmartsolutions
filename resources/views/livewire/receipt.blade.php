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
            <div x-show="saving" class="absolute inset-0 flex items-center justify-center bg-black/50 z-50 rounded-xl">
                <svg aria-hidden="true" class="w-8 h-8 text-white animate-spin fill-brand" viewBox="0 0 100 101"
                    fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
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
                    @if (session('receipt_type') === 'downpayment')
                        @php
                            $downPayment = session()->has('down_payment_id')
                                ? \App\Models\DownPayment::find(session('down_payment_id'))
                                : null;
                        @endphp

                        @if ($downPayment)
                            <div class="w-full flex items-center justify-between -mt-2">
                                <p class="text-sm">Payment:</p>
                                <p class="w-[35%] text-center">
                                    ₱{{ number_format($downPayment->amount, 2) }}
                                </p>
                            </div>

                            <div class="w-full flex items-center justify-between">
                                <p class="font-bold">Balance:</p>
                                <p class="w-[35%] text-center font-medium">
                                    ₱{{ number_format($order->remainingBalance(), 2) }}
                                </p>
                            </div>
                        @endif
                    @endif
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

    async function downloadAsImage() {
        const original = document.getElementById('capture-area');
        const cloneContainer = document.getElementById('clone-container');

        // Clone the receipt
        const clone = original.cloneNode(true);
        clone.classList.add('dom-capture');

        // Remove buttons
        const exclude = clone.querySelector('#exclude');
        if (exclude) exclude.remove();

        // Expand scroll area
        const scroll = clone.querySelector('#receipt-scroll');
        if (scroll) {
            scroll.style.maxHeight = 'none';
            scroll.style.overflow = 'visible';
        }

        cloneContainer.innerHTML = '';
        cloneContainer.appendChild(clone);

        // Wait for fonts and images
        await document.fonts.ready;
        await waitForImages(clone);

        // Capture and download
        domtoimage.toPng(clone, {
            bgcolor: '#ffffff',
            width: clone.offsetWidth,
            height: clone.scrollHeight,
            cacheBust: true
        }).then((dataUrl) => {
            const link = document.createElement('a');

            // ✅ Fix filename string
            const referenceId = "{{ session('referenceId') }}";
            link.download = `receipt_${referenceId}.png`;

            link.href = dataUrl;
            link.click();

            cloneContainer.innerHTML = '';
        }).catch(err => {
            console.error('Capture failed:', err);
        });
    }
</script>
