<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class ExpenseForm extends Component
{
    use WithFileUploads;

    public $title = null;
    public $category = null;
    public $amount = null;
    public $expense_date = null;
    public $remarks = '';
    public $proof;

    public function createExpense()
    {
        try {
            $validated = $this->validate([
                'title' => 'required',
                'category' => 'required',
                'amount' => 'required',
                'expense_date' => 'required|before_or_equal:today',
                'remarks' => 'nullable',
                'proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ], [
                'title.required' => 'Expense title is required.',
                'category.required' => 'Please select a category.',
                'amount.required' => 'Amount is required.',
                'amount.min' => 'Amount must be at least ₱1.',
                'expense_date.required' => 'Expense date is required.',
                'expense_date.before_or_equal' => 'Expense date cannot be in the future.',
                'proof.required' => 'Please upload a proof of expense.',
                'proof.file' => 'The proof must be a valid file.',
                'proof.mimes' => 'The proof must be a JPG, PNG, or PDF file only.',
                'proof.max' => 'The proof must not exceed 2MB.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $path = $this->proof->store('expenses', 'public');

        $expense = Expense::create([
            'title' => $this->title,
            'category' => $this->category,
            'amount' => $this->amount,
            'expense_date' => $this->expense_date,
            'remarks' => $this->remarks,
            'path' => $path,
        ]);

        notyf()->success('Expense saved successfully.');
        app(NotificationService::class)->createNotif(
            "Expense Added Successfully",
            "{$expense->title} has been added successfully.",
            ['owner', 'admin_officer'],
        );

        return redirect()->route('landing.page');
    }

    public function cancel()
    {
        $this->dispatch('cancel')->to('expense-browser');
    }

    public function render()
    {
        return view('livewire.expense-form');
    }
}
