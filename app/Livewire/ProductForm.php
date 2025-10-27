<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\ProductSerial;
use Livewire\WithFileUploads;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class ProductForm extends Component
{
    use WithFileUploads;
    public $name;
    public $supplier;
    public $categoryId;
    public $original_price;
    public $retail_price;
    public $min_limit;
    public $description;
    public $image;
    public $serial_numbers = [''];

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

    public function createProduct()
    {
        try {
            $this->validate([
                'serial_numbers' => 'required|array|min:1',
                'serial_numbers.*' => 'required|string|max:35|distinct',
                'name' => 'required|unique:products,name|max:255',
                'categoryId' => 'required|exists:categories,id',
                'supplier' => 'required',
                'original_price' => 'required|min:0',
                'retail_price' => 'required|min:0',
                'min_limit' => 'required|min:0',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ], [
                'serial_numbers.required' => 'At least one serial number is required.',
                'serial_numbers.*.required' => 'Each serial number must not be empty.',
                'serial_numbers.*.max' => 'Serial number must not exceed 35 characters.',
                'serial_numbers.*.distinct' => 'Duplicate serial numbers are not allowed.',
                'name.required' => 'Product name is required.',
                'name.unique' => 'Product name already existed.',
                'name.max' => 'Product name must not exceed 255 characters.',
                'categoryId.required' => 'Please select a category.',
                'categoryId.exists' => 'The selected category does not exist.',
                'supplier.required' => 'Supplier/Contributor is required.',
                'original_price.required' => 'Product price is required.',
                'original_price.min' => 'Product price must be zero or greater.',
                'retail_price.required' => 'Product price is required.',
                'retail_.min' => 'Product price must be zero or greater.',
                'min_limit.required' => 'Minimum stock is required.',
                'min_limit.min' => 'Minimum stock must be at least 0.',
                'description.required' => 'Product description is required.',
                'image.image' => 'Uploaded file must be an image.',
                'image.mimes' => 'Image must be a JPG, JPEG, or PNG file.',
                'image.max' => 'Image size must not exceed 5MB.',
            ]);

            $existingSerials = ProductSerial::whereIn('serial_number', $this->serial_numbers)->pluck('serial_number')->toArray();

            if (!empty($existingSerials)) {
                $duplicates = implode(', ', $existingSerials);
                notyf()->error("The following serial numbers already exist: {$duplicates}");
                return;
            }
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $path = 'products/no_image.png';
        if ($this->image) {
            $extension = $this->image->getClientOriginalExtension();
            $filename = $this->name . '.' . $extension;
            $path = $this->image->storeAs('products', $filename, 'public');
        }

        $product = Product::create([
            'name' => $this->name,
            'category_id' => $this->categoryId,
            'supplier' => $this->supplier,
            'original_price' => $this->original_price,
            'retail_price' => $this->retail_price,
            'description' => $this->description,
            'image_url' => $path,
            'min_limit' => $this->min_limit,
        ]);

        foreach ($this->serial_numbers as $serial) {
            $product->serials()->create([
                'serial_number' => $serial,
                'status' => 'available',
            ]);
        }

        app(NotificationService::class)->createNotif(
            Auth::user()->id,
            "Product Added Successfully",
            "{$product->name} has been successfully added to your inventory.",
            ['admin', 'cashier', 'admin_officer'],
        );

        notyf()->success('Product created successfully');
        return redirect()->route('landing.page');
    }

    public function render(CategoryService $categoryService)
    {
        return view('livewire.product-form', [
            'categories' => $categoryService->getAllCategory(),
        ]);
    }
}
