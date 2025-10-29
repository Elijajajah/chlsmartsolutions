<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class OrderList extends Component
{
    public $products = [];
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

    public function render()
    {
        return view('livewire.order-list');
    }
}
