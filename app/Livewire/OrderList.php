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
        $this->products = collect($saved)->map(function ($item) {
            return (object) $item;
        })->toArray();
    }

    public function updatedProducts($value, $key)
    {
        [$index, $field] = explode('.', $key);

        if ($field === 'quantity') {
            $product = $this->products[$index];
            $stock = $product->stock;

            $product->quantity = max(1, min((int) $product->quantity, $stock));
            session()->put('cartItems', $this->products);
        }
    }

    public function updateProductsList($selectedProducts)
    {
        foreach ($selectedProducts as $item) {

            $product = Product::with('inventory')->findOrFail($item['id']);

            if ($product->inventory->stock < 1) {
                notyf()->error("{$product->name} is not available");
                continue;
            }

            $alreadyExists = false;

            foreach ($this->products as $existing) {
                if ($existing->id == $product->id) {
                    if ($existing->quantity < $existing->stock) {
                        $existing->quantity++;
                        notyf()->success('Products added successfully.');
                        session()->put('cartItems', $this->products);
                    }
                    $alreadyExists = true;
                    break;
                }
            }

            if ($alreadyExists) {
                continue;
            }

            $this->products[] = (object)[
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->inventory->stock,
                'quantity' => 1,
            ];

            notyf()->success('Products added successfully.');
        }

        session()->put('cartItems', $this->products);
    }


    public function removeProduct($id)
    {
        foreach ($this->products as $index => $item) {
            if ($item->id == $id){
                unset($this->products[$index]);
            }
        }
        session()->put('cartItems', $this->products);

    }

    public function getTotalAmountProperty()
    {
        $total = 0;
        foreach ($this->products as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
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
