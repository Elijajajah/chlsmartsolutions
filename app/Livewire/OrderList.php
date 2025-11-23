<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Http\Controllers\OrderController;
use Illuminate\Validation\ValidationException;

class OrderList extends Component
{
    public $products = [];
    public $type = '', $customer_name = '', $payment_method = 'none', $tax = '';
    protected $listeners = ['addProducts' => 'updateProductsList'];

    public function mount()
    {
        $saved = session()->get('cartItems', []);
        $this->products = collect($saved)->map(fn($item) => (object) $item)->toArray();
    }

    public function updatedProducts($value, $key)
    {
        [$index, $field] = explode('.', $key);
        if ($field !== 'quantity') return;

        $product = $this->products[$index] ?? null;
        if (!$product) return;

        $productModel = Product::with('serials')->find($product->id);
        if (!$productModel) return;

        // Get available serials
        $availableSerials = $productModel->serials()
            ->where('status', 'available')
            ->pluck('serial_number')
            ->toArray();

        $requestedQuantity = max(1, min((int) $value, count($availableSerials)));
        $currentSerials = $product->serials ?? [];

        // Assign random serials if increasing quantity
        if ($requestedQuantity > count($currentSerials)) {
            $remaining = array_diff($availableSerials, $currentSerials);
            shuffle($remaining);
            $toAdd = array_slice($remaining, 0, $requestedQuantity - count($currentSerials));
            $product->serials = array_merge($currentSerials, $toAdd);
        }
        // Reduce serials if lowering quantity
        elseif ($requestedQuantity < count($currentSerials)) {
            $product->serials = array_slice($currentSerials, 0, $requestedQuantity);
        }

        // Update and store session
        $product->quantity = $requestedQuantity;
        $this->products[$index] = $product;
        session()->put('cartItems', $this->products);
    }

    public function updateProductsList($selectedProducts)
    {
        foreach ($selectedProducts as $item) {
            $product = Product::with('serials')->findOrFail($item['id']);
            $availableSerials = $product->serials()
                ->where('status', 'available')
                ->pluck('serial_number')
                ->toArray();

            if (empty($availableSerials)) {
                notyf()->error("{$product->name} is not available");
                continue;
            }

            // Check if already exists
            $existing = collect($this->products)->firstWhere('id', $product->id);
            if ($existing) {
                $remaining = array_diff($availableSerials, $existing->serials ?? []);
                if ($remaining) {
                    $existing->serials[] = array_shift($remaining);
                    $existing->quantity = count($existing->serials);
                    notyf()->success("Added another {$product->name}.");
                } else {
                    notyf()->error("No more stock available for {$product->name}.");
                }
            } else {
                // Add new product
                shuffle($availableSerials);
                $this->products[] = (object) [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->retail_price,
                    'stock' => count($availableSerials),
                    'serials' => [array_shift($availableSerials)],
                    'quantity' => 1,
                ];
                notyf()->success("{$product->name} added successfully.");
            }
        }

        session()->put('cartItems', $this->products);
    }

    public function increaseQuantity($index)
    {
        if (!isset($this->products[$index])) return;

        $product = $this->products[$index];

        // Load product with serials
        $model = Product::with('serials')->find($product->id);
        if (!$model) return;

        $availableSerials = $model->serials()
            ->where('status', 'available')
            ->pluck('serial_number')
            ->toArray();

        $currentSerials = $product->serials ?? [];
        $currentQty = count($currentSerials);
        $maxStock = count($availableSerials);

        // ❌ If already at max stock, stop
        if ($currentQty >= $maxStock) {
            notyf()->error("Only {$maxStock} stocks available for {$product->name}.");
            return;
        }

        // Assign a new serial from the remaining serials
        $remaining = array_diff($availableSerials, $currentSerials);
        shuffle($remaining);

        $nextSerial = array_shift($remaining);
        $product->serials[] = $nextSerial;

        $product->quantity = count($product->serials);
        $this->products[$index] = $product;

        session()->put('cartItems', $this->products);
    }

    public function decreaseQuantity($index)
    {
        if (!isset($this->products[$index])) return;

        $product = $this->products[$index];
        $currentSerials = $product->serials ?? [];

        // ❌ Don't go below quantity 1
        if (count($currentSerials) <= 1) {
            return;
        }

        // Remove last serial
        array_pop($currentSerials);

        $product->serials = $currentSerials;
        $product->quantity = count($currentSerials);

        $this->products[$index] = $product;

        session()->put('cartItems', $this->products);
    }

    public function removeProduct($id)
    {
        foreach ($this->products as $index => $item) {
            if ($item->id == $id) {
                unset($this->products[$index]);
                break;
            }
        }

        $this->products = array_values($this->products);
        session()->put('cartItems', $this->products);
        notyf()->success('Product removed.');
    }

    public function getTotalAmountProperty()
    {
        return collect($this->products)->sum(function ($item) {
            $quantity = isset($item->serials) ? count($item->serials) : ($item->quantity ?? 1);
            return $quantity * $item->price;
        });
    }

    public function getTotalProductProperty()
    {
        return count($this->products);
    }

    public function submit()
    {
        try {
            $this->validate([
                'customer_name'   => 'required|max:100',
                'type'            => 'required|in:walk_in,project_based,government',
                'payment_method'  => 'required|not_in:none',
                'tax'             => 'required_if:type,government|min:0',
            ], [
                'customer_name.required' => 'Please insert a customer name.',
                'type.required' => 'Please select a customer type.',
                'payment_method.required' => 'Please select a payment method.',
                'tax.required_if' => 'Tax is required for government customers.',
                'tax.min' => 'Tax cannot be negative.',
            ]);

            if (empty(session('cartItems'))) {
                notyf()->error('Your product list is empty.');
                return;
            }
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        return app(OrderController::class)
            ->createOrder(request()->merge([
                'customer_name' => $this->customer_name,
                'type' => $this->type,
                'payment_method' => $this->payment_method,
                'tax' => $this->tax,
                'total_amount' => $this->totalAmount,
            ]));
    }

    public function render()
    {
        return view('livewire.order-list');
    }
}
