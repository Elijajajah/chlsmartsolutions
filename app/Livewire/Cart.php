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
        $product = Product::with('serials')->findOrFail($productId);

        // 🔹 Get available serials for this product
        $availableSerials = $product->serials()->where('status', 'available')->pluck('serial_number')->toArray();

        // 🔹 Check if product already exists in cart
        foreach ($this->cartItems as $item) {
            if ($item->id == $product->id) {
                // If product already in cart, append the next available serial
                $existingSerials = collect($item->serials);
                $remainingSerials = array_diff($availableSerials, $existingSerials->toArray());

                if (count($remainingSerials) > 0) {
                    $item->serials[] = array_shift($remainingSerials); // add 1 serial
                    session()->put('cartItems', $this->cartItems);
                    notyf()->success('Product has been added.');
                }
                return;
            }
        }

        // 🔹 If product not yet in cart, create a new entry with first serial
        $this->cartItems[] = (object) [
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->retail_price,
            'image_url' => $product->image_url,
            'stock' => count($availableSerials),
            'serials' => [array_shift($availableSerials)], // store first serial number
        ];

        session()->put('cartItems', $this->cartItems);
        notyf()->success('Product has been added.');
    }


    public function mount()
    {
        $this->cartItems = session()->get('cartItems', []);
    }

    public function increaseQuantity($id)
    {
        foreach ($this->cartItems as $item) {
            if ($item->id == $id) {
                $product = Product::with('serials')->findOrFail($id);

                // Get available serials that aren't already in the cart
                $availableSerials = $product->serials()
                    ->where('status', 'available')
                    ->pluck('serial_number')
                    ->toArray();

                $alreadyInCart = $item->serials ?? [];
                $remainingSerials = array_diff($availableSerials, $alreadyInCart);

                if (count($remainingSerials) > 0) {
                    // Add one more serial number
                    $item->serials[] = array_shift($remainingSerials);
                    session()->put('cartItems', $this->cartItems);
                }

                return;
            }
        }
    }

    public function decreaseQuantity($id)
    {
        foreach ($this->cartItems as $key => $item) {
            if ($item->id == $id) {
                if (isset($item->serials) && count($item->serials) > 1) {
                    // Remove the last added serial number
                    array_pop($item->serials);
                    session()->put('cartItems', $this->cartItems);
                } else {
                    // If only one left, remove entire product
                    unset($this->cartItems[$key]);
                    session()->put('cartItems', array_values($this->cartItems));
                }
                return;
            }
        }
    }

    public function removeItem($id)
    {
        foreach ($this->cartItems as $index => $item) {
            if ($item->id == $id) {
                unset($this->cartItems[$index]);
                break;
            }
        }

        $this->cartItems = array_values($this->cartItems);

        session()->put('cartItems', $this->cartItems);
        notyf()->success('Product removed from cart.');
    }


    public function getTotalItemsProperty()
    {
        return count($this->cartItems);
    }

    public function totalPrice($id)
    {
        foreach ($this->cartItems as $item) {
            if ($item->id == $id) {
                $serialCount = isset($item->serials) ? count($item->serials) : 0;
                return $serialCount * $item->price;
            }
        }

        return 0;
    }


    public function getTotalAmountProperty()
    {
        $total = 0;
        foreach ($this->cartItems as $item) {
            $serialCount = isset($item->serials) ? count($item->serials) : 0;
            $total += $serialCount * $item->price;
        }

        return $total;
    }


    public function render()
    {
        return view('livewire.cart');
    }
}
