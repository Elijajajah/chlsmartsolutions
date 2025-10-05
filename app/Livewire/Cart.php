<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];
    protected $listeners = ['addToCart'];
    public function addToCart($payload)
    {
        $productId = $payload['id'];

        $product = Product::with(['inventory'])->findOrFail($productId);

        foreach ($this->cartItems as $item) {
            if ($item->id == $product->id){
                if ($item->quantity < $item->stock){
                    $item->quantity++;
                    session()->put('cartItems', $this->cartItems);
                    notyf()->success('You’ve added the product to your cart.');
                    return;
                }
                return;
            }
        }

        $this->cartItems[] = (object)[
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'stock' => $product->inventory->stock,
            'quantity' => 1,
        ];

        notyf()->success('You’ve added the product to your cart.');

        session()->put('cartItems', $this->cartItems);
    }

    public function mount()
    {
        $this->cartItems = session()->get('cartItems', []);
    }

    public function increaseQuantity($id)
    {
        foreach ($this->cartItems as $item) {
            if ($item->id == $id && $item->quantity < $item->stock){
                $item->quantity++;
            }
        }
        session()->put('cartItems', $this->cartItems);
    }

    public function decreaseQuantity($id)
    {
        foreach ($this->cartItems as $item) {
            if ($item->id == $id && $item->quantity > 1){
                $item->quantity--;
            }
        }
        session()->put('cartItems', $this->cartItems);
    }

    public function removeItem($id)
    {
        foreach ($this->cartItems as $index => $item) {
            if ($item->id == $id){
                unset($this->cartItems[$index]);
            }
        }
        session()->put('cartItems', $this->cartItems);
    }

    public function getTotalItemsProperty()
    {
        return count($this->cartItems);
    }

    public function totalPrice($id)
    {
        foreach ($this->cartItems as $item) {
            if ($item->id == $id) {
                return $item->quantity * $item->price;
            }
        }

        return 0;
    }

    public function getTotalAmountProperty()
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $total += $item->quantity * $item->price;
        }
        return $total;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
