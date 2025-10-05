<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Validation\ValidationException;

class AddCategory extends Component
{
    public $name = '';

    public function createCategory()
    {
        try {
            $validator = $this->validate([
                'name' => 'required',
            ], [
                'name.required' => 'The Category name is required.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        Category::create($validator);
        notyf()->success('Category created successfully');

        return redirect()->route('landing.page');
    }

    public function render()
    {
        return view('livewire.add-category');
    }
}
