<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class InventoryOverview extends Component
{
    public $active = '';
    public $take = 2;

    public function mount($take = 2)
    {
        $this->take = $take;
    }

    public function setActive($option)
    {
        $this->active = $option;
        session()->put('sidebar_active', $option);
        $this->dispatch('activate', $option)->to('sidebar');
    }

    public function getStocks()
    {
        $products = Product::with(['serials', 'category'])->get();

        $filtered = $products->filter(function ($product) {
            $availableStock = $product->availableReservedCount();

            $minStockLimit = $product->min_limit ?? 5;

            // Include products that are out of stock or low on stock
            return $availableStock <= 0 || $availableStock <= $minStockLimit;
        });

        // Sort by stock (lowest first)
        $sorted = $filtered->sortBy(function ($product) {
            return $product->availableReservedCount();
        });

        // Return limited list (for dashboard etc.)
        return $sorted->take($this->take)->values();
    }




    public function render()
    {
        return view('livewire.inventory-overview', [
            'products' => $this->getStocks(),
        ]);
    }
}
