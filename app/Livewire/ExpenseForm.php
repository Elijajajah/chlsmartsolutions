<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class ExpenseForm extends Component
{
    public $title = null;
    public $category = null;
    public $amount = null;
    public $expense_date = null;
    public $remarks = '';

    public function createExpense()
    {
        try {
            $validated = $this->validate([
                'title' => 'required',
                'category' => 'required',
                'amount' => 'required',
                'expense_date' => 'required|before_or_equal:today',
                'remarks' => 'nullable',
            ], [
                'title.required' => 'Expense title is required.',
                'category.required' => 'Please select a category.',
                'amount.required' => 'Amount is required.',
                'amount.min' => 'Amount must be at least ₱1.',
                'expense_date.required' => 'Expense date is required.',
                'expense_date.before_or_equal' => 'Expense date cannot be in the future.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $expense = Expense::create($validated);
        notyf()->success('Expense saved successfully.');
        app(NotificationService::class)->createNotif(
                    Auth::user()->id,
                    "Expense Added Successfully",
                    "{$expense->title} has been added successfully.",
                    ['admin', 'cashier', 'admin_officer'],
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
