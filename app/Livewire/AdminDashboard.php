<?php

namespace App\Livewire;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $selectedDate = 'this_year';
    public $startDate;

    public function mount()
    {
        $this->startDate = now()->startOfYear()->toDateString();
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

    public function exportAllReports()
    {
        return redirect()->to(route('export.all', ['startDate' => $this->startDate]));
    }

    public function render()
    {
        return view('livewire.admin-dashboard');
    }
}
