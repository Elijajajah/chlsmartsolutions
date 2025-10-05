<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $query = '';
    public $results = [];
    public $selected = [];

    public function mount()
    {
        $this->selected = session()->get('selected_products', []);
    }

    public function updatedQuery()
    {
        $this->results = Product::where('name', 'like', '%' . $this->query . '%')
            ->limit(5)
            ->get();
    }

    public function selectProduct($id)
    {
        $product = Product::find($id);
        if ($product && !collect($this->selected)->pluck('id')->contains($id)) {
            $this->selected[] = (object)[
                'id' => $product->id,
                'name' => $product->name,
            ];
        }

        session()->put('selected_products', $this->selected);

        $this->query = '';
        $this->results = [];
    }

    public function removeProduct($id)
    {
        foreach ($this->selected as $index => $item) {
            if ($item->id == $id){
                unset($this->selected[$index]);
            }
        }
        session()->put('selected_products', $this->selected);
    }

    public function render()
    {
        return view('livewire.product-search');
    }

    public function addProducts()
    {
        $this->dispatch('addProducts', $this->selected);
        $this->query = '';
        $this->selected = [];
        session()->forget('selected_products');
    }
}
