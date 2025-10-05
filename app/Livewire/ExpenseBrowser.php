<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ExpenseService;
use Livewire\WithoutUrlPagination;

class ExpenseBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $category = 'monthly dues';
    public $showModal = false;
    protected $listeners = ['cancel' => 'closeModal'];
    public $selectedDate = 'this_year';
    public $startDate;

    public function mount()
    {
        $this->startDate = now()->startOfYear()->toDateString();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function updated($property)
    {
        if ($property === 'selectedStatus' || $property === 'search') {
            $this->gotoPage(1);
        }
    }

    public function updatedSelectedDate($value)
    {
        match ($value) {
            'today' => $this->startDate = now()->toDateString(),
            'this_week' => $this->startDate = now()->startOfWeek()->toDateString(),
            'this_month' => $this->startDate = now()->startOfMonth()->toDateString(),
            'this_year' => $this->startDate = now()->startOfYear()->toDateString(),
            default => null,
        };
    }

    public function getExpenseProperty()
    {
        return Expense::all();
    }

    public function exportExpenses()
    {
        return redirect()->to(route('export.expenses', ['startDate' => $this->startDate]));
    }

    public function render(ExpenseService $expenseService)
    {
        return view('livewire.expense-browser', [
            'data' => $expenseService->getFilteredExpense($this->startDate),
            'expenses' => $expenseService->getFilteredExpensePaginated($this->startDate, $this->category),
        ]);
    }
}
