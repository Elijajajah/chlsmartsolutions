<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithoutUrlPagination;

class ProductBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $categories = [];
    public $search = '';
    public $searchCat = '';
    public $selectedCategory = 0;
    public $quantity = 0;
    public $selectedStock = null;
    public $showModal = false;
    public string $activeTab = 'productBrowse';
    public $editingId = null;
    public $productId = null;
    public $name = '';

    public function mount(CategoryService $categoryService)
    {
        $this->categories = $categoryService->getAllCategory();
    }

    public function selectStock($stock_id)
    {
        $this->showModal = true;
        $this->selectedStock = Product::with('inventory')->find($stock_id);
    }

    public function restockProduct($product_id)
    {
        $quantity = $this->quantity;
        $product = $this->selectedStock;
        if (($product->inventory->stock + $quantity) > $product->inventory->stock_max_limit) {
            notyf()->error('Stock exceeds the maximum allowed limit.');
            return;
        }
        $product->inventory->stock += $quantity;
        $product->save();
        notyf()->success('Stock updated successfully.');
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedStock = null;
    }

    public function updated($property)
    {
        if ($property === 'selectedCategory' || $property === 'search') {
            $this->gotoPage(1);
        }
    }

    public function getAllProductsProperty()
    {
        return Product::count();
    }

    public function getAllCategoryProperty()
    {
        return Category::count();
    }

    public function getStocks($status)
    {
        $products = Product::with('inventory', 'orderProducts.order')->get();

        return $products->filter(function ($product) use ($status) {
            $inventory = $product->inventory;

            $pendingQuantity = $product->orderProducts
                ->where('order.status', 'pending')
                ->sum('quantity');

            $adjustedStock = $inventory->stock + $pendingQuantity;

            if ($status === 'out') {
                return $adjustedStock === 0;
            }

            if ($status === 'low') {
                return $adjustedStock <= $inventory->stock_min_limit && $adjustedStock > 0;
            }

            return false;
        })->values();
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        if ($this->editingId === $id) {
            if ($this->name != $category->name){
                $category->name = $this->name;
                $category->save();
                notyf()->success('Category is renamed successfully');
            }
            $this->editingId = null;
        } else {
            $this->name = $category->name;
            $this->editingId = $id;
        }
    }

    public function removeCategory($id)
    {
        $category = Category::find($id);
        $category->delete();
        notyf()->success('Category deleted successfully.');
    }

    public function editProduct($id)
    {
        $this->activeTab = "editProduct";
        $this->productId = $id;
    }

    public function render(ProductService $productService, CategoryService $categoryService)
    {
        return view('livewire.product-browser', [
            'topProducts' => $productService->getTopSellingProduct()->take(4),
            'products' => $productService->getProductWithStock($this->selectedCategory, $this->search),
            'categs' => $categoryService->getCategory($this->searchCat),
            'lowStocks' => $this->getStocks('low')->take(5),
            'outStocks' => $this->getStocks('out')->take(5),
        ]);
    }
}
