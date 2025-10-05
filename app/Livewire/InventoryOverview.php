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
        $products = Product::with('inventory', 'orderProducts.order')->get();

        $filtered = $products->filter(function ($product) {
            $inventory = $product->inventory;

            $pendingQuantity = $product->orderProducts
                ->where('order.status', 'pending')
                ->sum('quantity');

            $adjustedStock = $inventory->stock + $pendingQuantity;

            return $adjustedStock === 0 || $adjustedStock <= $inventory->stock_min_limit;
        });

        // Sort by least quantity first
        $sorted = $filtered->sortBy(function ($product) {
            $inventory = $product->inventory;
            $pendingQuantity = $product->orderProducts
                ->where('order.status', 'pending')
                ->sum('quantity');
            return $inventory->stock + $pendingQuantity;
        });

        return $sorted->take($this->take)->values();
    }


    public function render()
    {
        return view('livewire.inventory-overview', [
            'products' => $this->getStocks(),
        ]);
    }
}
