<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class EditProductForm extends Component
{
    use WithFileUploads;
    public $serial_number;
    public $name;
    public $categoryId;
    public $categoryName;
    public $price;
    public $description;
    public $stock;
    public $stock_min_limit;
    public $stock_max_limit;
    public $image;
    public $selectedProductId = null;

    public function mount($id)
    {
        $product = Product::with('inventory', 'category')->find($id);
        if ($product) {
            $this->selectedProductId = $product->id;
            $this->serial_number = $product->serial_number;
            $this->name = $product->name;
            $this->categoryId = $product->category_id;
            $this->categoryName = $product->category->name;
            $this->price = $product->price;
            $this->stock = $product->inventory->stock;
            $this->stock_min_limit = $product->inventory->stock_min_limit;
            $this->stock_max_limit = $product->inventory->stock_max_limit;
            $this->description = $product->description;
            $this->image = $product->image_url;
        }
    }

    public function editProduct()
    {
        $product = Product::with('inventory')->find($this->selectedProductId);

        $hasChanges = false;

        $fields = [
            'serial_number' => $this->serial_number !== $product->serial_number,
            'name' => $this->name !== $product->name,
            'categoryId' => $this->categoryId != $product->category_id,
            'price' => $this->price != $product->price,
            'description' => $this->description !== $product->description,
            'stock' => $this->stock != $product->inventory->stock,
            'stock_min_limit' => $this->stock_min_limit != $product->inventory->stock_min_limit,
            'stock_max_limit' => $this->stock_max_limit != $product->inventory->stock_max_limit,
            'image' => $this->image !== $product->image_url,
        ];

        foreach ($fields as $changed) {
            if ($changed) {
                $hasChanges = true;
                break;
            }
        }

        if (!$hasChanges) {
            notyf()->info('No changes made to the product.');
            return;
        }

        try {
            $this->validate([
                'serial_number' => 'required|max:50|unique:products,serial_number,' . $product->id,
                'name' => 'required|max:255|unique:products,name,' . $product->id,
                'categoryId' => 'required|exists:categories,id',
                'price' => 'required|min:0',
                'stock' => 'required|min:0',
                'stock_min_limit' => 'required|min:0',
                'stock_max_limit' => 'required|gte:stock_min_limit',
                'description' => 'required',
                'image' => 'nullable|max:5120'
            ], [
                'serial_number.required' => 'Serial Number is required.',
                'serial_number.max' => 'Serial Number must not exceed 50 characters.',
                'serial_number.unique' => 'This Serial Number is already taken.',
                'name.required' => 'Product name is required.',
                'name.max' => 'Product name must not exceed 255 characters.',
                'name.unique' => 'This product name is already taken.',
                'categoryId.required' => 'Please select a category.',
                'categoryId.exists' => 'Selected category does not exist.',
                'price.required' => 'Price is required.',
                'price.min' => 'Price must be 0 or higher.',
                'stock.required' => 'Stock is required.',
                'stock.min' => 'Stock must be 0 or higher.',
                'stock_min_limit.required' => 'Minimum stock is required.',
                'stock_min_limit.min' => 'Minimum stock must be at least 0.',
                'stock_max_limit.required' => 'Maximum stock is required.',
                'stock_max_limit.gte' => 'Maximum stock must be greater than or equal to minimum stock.',
                'description.required' => 'Product description is required.',
                'image.max' => 'Image size must not exceed 5MB.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $path = '/products/no_image.png';
        if ($this->image !== $product->image_url && $this->image != null) {
            if ($product->image_url && $product->image_url !== '/products/no_image.png') {
                Storage::disk('public')->delete($product->image_url);
            }

            $extension = $this->image->getClientOriginalExtension();
            $filename = $this->name . '.' . $extension;
            $path = $this->image->storeAs('products', $filename, 'public');
        }

        $product->update([
            'serial_number' => $this->serial_number,
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'price' => $this->price,
            'description' => $this->description,
            'image_url' => $path
        ]);

        $product->inventory->update([
            'stock' => $this->stock,
            'stock_min_limit' => $this->stock_min_limit,
            'stock_max_limit' => $this->stock_max_limit,
        ]);

        notyf()->success('Product updated successfully.');
        return redirect()->route('landing.page');
    }

    public function render(CategoryService $categoryService)
    {
        return view('livewire.edit-product-form', [
            'categories' => $categoryService->getAllCategory(),
        ]);
    }
}
