<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Illuminate\Validation\ValidationException;

class AddSupplier extends Component
{
    public $name = '';

    public function createSupplier()
    {
        try {
            $validator = $this->validate([
                'name' => 'required|unique:suppliers,name',
            ], [
                'name.required' => 'The Supplier name is required.',
                'name.unique'   => 'This supplier name already exists.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        Supplier::create($validator);
        notyf()->success('Supplier created successfully');
        return redirect()->route('landing.page');
    }

    public function render()
    {
        return view('livewire.add-supplier');
    }
}
