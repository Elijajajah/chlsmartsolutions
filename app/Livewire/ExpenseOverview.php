<?php

namespace App\Livewire;

use App\Models\Expense;
use Livewire\Component;

class ExpenseOverview extends Component
{
    public $active = '';
    public $take = 2;

    public function mount($take = 2)
    {
        $this->take = $take;
    }

    public function setActive($option)
    {
        $this->active = $option;
        session()->put('sidebar_active', $option);
        $this->dispatch('activate', $option)->to('sidebar');
    }

    public function getExpense()
    {
        return Expense::orderBy('created_at', 'desc')->take($this->take)->get();
    }

    public function render()
    {
        return view('livewire.expense-overview', [
            'expenses' => $this->getExpense()
        ]);
    }
}
