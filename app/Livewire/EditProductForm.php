<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\ProductSerial;
use Livewire\WithFileUploads;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditProductForm extends Component
{
    use WithFileUploads;
    public $name;
    public $supplier;
    public $categoryId;
    public $categoryName;
    public $min_limit;
    public $original_price;
    public $retail_price;
    public $description;
    public $image;
    public $selectedProductId = null;
    public $serial_numbers = [''];

    public function mount($id)
    {
        $product = Product::with(['serials' => function ($query) {
            $query->whereIn('status', ['available', 'reserved']);
        }, 'category'])->find($id);

        if ($product) {
            $this->selectedProductId = $product->id;
            $this->name = $product->name;
            $this->supplier = $product->supplier;
            $this->categoryId = $product->category_id;
            $this->categoryName = $product->category->name;
            $this->min_limit = $product->min_limit;
            $this->original_price = $product->original_price;
            $this->retail_price = $product->retail_price;
            $this->description = $product->description;
            $this->image = $product->image_url;
            $this->serial_numbers = $product->serials->pluck('serial_number')->toArray();
        }
    }

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

    public function editProduct()
    {
        $product = Product::find($this->selectedProductId);

        if (!$product) {
            notyf()->error('Product not found.');
            return;
        }

        $existingSerials = ProductSerial::where('product_id', $product->id)
            ->whereIn('status', ['available', 'reserved'])
            ->pluck('serial_number')
            ->toArray();

        $newSerials = array_map('trim', $this->serial_numbers);

        $serialsChanged = count(array_diff($existingSerials, $newSerials)) > 0 ||
            count(array_diff($newSerials, $existingSerials)) > 0;

        $hasChanges =
            $this->name !== $product->name ||
            $this->supplier !== $product->supplier ||
            $this->categoryId != $product->category_id ||
            $this->retail_price != $product->retail_price ||
            $this->description !== $product->description ||
            $this->min_limit != $product->min_limit ||
            $serialsChanged ||
            ($this->image instanceof TemporaryUploadedFile);

        if (!$hasChanges) {
            notyf()->info('No changes made to the product.');
            return;
        }

        try {
            $rules = [
                'serial_numbers'     => 'required|array|min:1',
                'serial_numbers.*'   => 'required|string|max:35|distinct',
                'name'               => 'required|max:255|unique:products,name,' . $product->id,
                'categoryId'         => 'required|exists:categories,id',
                'supplier'           => 'required',
                'original_price'     => 'required|numeric|min:0',
                'retail_price'       => 'required|numeric|min:0',
                'min_limit'          => 'required|integer|min:0',
                'description'        => 'required',
            ];

            if ($this->image instanceof TemporaryUploadedFile) {
                $rules['image'] = 'image|mimes:jpg,jpeg,png|max:5120';
            }

            $messages = [
                'serial_numbers.required'        => 'At least one serial number is required.',
                'serial_numbers.*.required'      => 'Each serial number must not be empty.',
                'serial_numbers.*.max'           => 'Serial number must not exceed 35 characters.',
                'serial_numbers.*.distinct'      => 'Duplicate serial numbers are not allowed.',
                'name.required'                  => 'Product name is required.',
                'name.unique'                    => 'Product name already existed.',
                'name.max'                       => 'Product name must not exceed 255 characters.',
                'categoryId.required'            => 'Please select a category.',
                'categoryId.exists'              => 'The selected category does not exist.',
                'supplier.required'              => 'Supplier/Contributor is required.',
                'original_price.required'        => 'Original price is required.',
                'original_price.numeric'         => 'Original price must be a number.',
                'original_price.min'             => 'Original price must be zero or greater.',
                'retail_price.required'          => 'Retail price is required.',
                'retail_price.numeric'           => 'Retail price must be a number.',
                'retail_price.min'               => 'Retail price must be zero or greater.',
                'min_limit.required'             => 'Minimum stock is required.',
                'min_limit.integer'              => 'Minimum stock must be an integer.',
                'min_limit.min'                  => 'Minimum stock must be at least 0.',
                'description.required'           => 'Product description is required.',
                'image.image'                    => 'Uploaded file must be an image.',
                'image.mimes'                    => 'Image must be a JPG, JPEG, or PNG file.',
                'image.max'                      => 'Image size must not exceed 5MB.',
            ];

            $this->validate($rules, $messages);

            $trimmedSerials = array_filter(array_map('trim', $this->serial_numbers));

            $existingSerials = ProductSerial::whereIn('serial_number', $trimmedSerials)
                ->where('product_id', '!=', $product->id)
                ->pluck('serial_number')
                ->toArray();

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



        $path = $product->image_url;
        if ($this->image instanceof TemporaryUploadedFile) {
            if ($product->image_url && $product->image_url !== 'products/no_image.png') {
                Storage::disk('public')->delete($product->image_url);
            }

            $filename = str_replace(' ', '_', strtolower($this->name)) . '_' . time() . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('products', $filename, 'public');
        }

        $product->update([
            'name' => $this->name,
            'supplier' => $this->supplier,
            'category_id' => $this->categoryId,
            'original_price' => $this->original_price,
            'retail_price' => $this->retail_price,
            'description' => $this->description,
            'min_limit' => $this->min_limit,
            'image_url' => $path,
        ]);

        if (!empty($this->serial_numbers)) {
            $existingSerialModels = ProductSerial::where('product_id', $product->id)
                ->whereIn('status', ['available', 'reserved'])
                ->get();

            $existingSerialNumbers = $existingSerialModels->pluck('serial_number')->toArray();
            $newSerialNumbers = array_map('trim', $this->serial_numbers);

            $serialsToDelete = array_diff($existingSerialNumbers, $newSerialNumbers);
            if (!empty($serialsToDelete)) {
                ProductSerial::where('product_id', $product->id)
                    ->whereIn('serial_number', $serialsToDelete)
                    ->delete();
            }

            foreach ($newSerialNumbers as $serial) {
                if (empty($serial)) continue;

                $existing = $existingSerialModels->firstWhere('serial_number', $serial);
                if (!$existing) {
                    ProductSerial::create([
                        'product_id' => $product->id,
                        'serial_number' => $serial,
                        'status' => 'available',
                    ]);
                }
            }
        }

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
