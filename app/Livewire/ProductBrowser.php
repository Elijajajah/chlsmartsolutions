<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use App\Models\ProductSerial;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithoutUrlPagination;
use Illuminate\Validation\ValidationException;

class ProductBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $categories = [];
    public $search = '';
    public $searchCat = '';
    public $selectedCategory = 0;
    public $selectedStock = null;
    public $showModal = false;
    public string $activeTab = 'productBrowse';
    public $editingId = null;
    public $productId = null;
    public $name = '';
    public $serial_numbers;

    public function addSerial()
    {
        if (empty(trim(end($this->serial_numbers)))) {
            notyf()->error('Please fill in serial number first.');
            return;
        }
        $this->serial_numbers[] = '';
    }

    public function removeSerial($index)
    {
        unset($this->serial_numbers[$index]);
        $this->serial_numbers = array_values($this->serial_numbers);
    }

    public function mount(CategoryService $categoryService)
    {
        $this->categories = $categoryService->getAllCategory();
    }

    public function selectStock($id)
    {
        $this->showModal = true;
        $this->selectedStock = Product::find($id);
        $this->serial_numbers = [''];
    }

    public function restockProduct($product_id)
    {
        $product = $this->selectedStock;

        if (!$product) {
            notyf()->error('Product not found.');
            return;
        }

        if (in_array('', array_map('trim', $this->serial_numbers), true)) {
            notyf()->error('Please fill in all serial numbers.');
            return;
        }

        if (count($this->serial_numbers) !== count(array_unique($this->serial_numbers))) {
            notyf()->error('Duplicate serial numbers detected.');
            return;
        }

        $existingSerials = ProductSerial::whereIn('serial_number', $this->serial_numbers)->pluck('serial_number')->toArray();
        if (!empty($existingSerials)) {
            $duplicates = implode(', ', $existingSerials);
            notyf()->error("These serial numbers already exist: {$duplicates}");
            return;
        }

        $currentStock = $product->serials()->count();
        $newStock = $currentStock + count($this->serial_numbers);

        foreach ($this->serial_numbers as $serial) {
            $product->serials()->create([
                'serial_number' => trim($serial),
                'status' => 'available',
            ]);
        }

        notyf()->success('Product restocked successfully.');
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
        $products = Product::with(['serials', 'category'])->get();

        return $products->filter(function ($product) use ($status) {
            $availableCount = $product->availableCount();

            if ($status === 'out') {
                return $availableCount <= 0;
            }

            if ($status === 'low') {
                return $availableCount > 0 && $availableCount <= ($product->min_limit ?? 5);
            }

            return false;
        })->values();
    }

    public function editCategory($id)
    {
        $category = Category::find($id);

        // If already editing → save
        if ($this->editingId === $id) {

            // Validate only when saving
            try {
                $this->validate([
                    'name' => 'required|unique:categories,name,' . $id,
                ], [
                    'name.required' => 'The Category name is required.',
                    'name.unique'   => 'This category name already exists.',
                ]);
            } catch (ValidationException $e) {
                notyf()->error($e->validator->errors()->first());
                return;
            }

            // Only save if something changed
            if ($this->name != $category->name) {
                $category->name = $this->name;
                $category->save();
                notyf()->success('Category is renamed successfully');
            }

            $this->editingId = null;
            return;
        }

        // Not editing → start editing
        $this->name = $category->name;
        $this->editingId = $id;
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
