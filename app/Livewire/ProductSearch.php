<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductSearch extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $query = '';
    public $selected = [];

    protected $paginationTheme = 'tailwind';

    public function mount()
    {
        $this->selected = session()->get('selected_products', []);
    }

    public function updatedQuery()
    {
        $this->resetPage();
    }

    public function selectProduct($id)
    {
        $product = Product::with('category')->find($id);

        if ($product) {
            $item = (object)[
                'id' => $product->id,
                'name' => $product->name,
                'category' => $product->category->name,
                'stock' => $product->availableCount(),
            ];

            $this->selected[] = $item;
            session()->put('selected_products', $this->selected);

            $this->dispatch('addProducts', [$item]);
        }
    }


    public function render()
    {
        $products = Product::with(['category', 'serials' => fn($q) => $q->where('status', 'available')])
            ->when($this->query, fn($q) => $q->where('name', 'like', '%' . $this->query . '%'))
            ->orderByDesc('created_at')
            ->paginate(6);

        return view('livewire.product-search', [
            'products' => $products,
        ]);
    }
}
