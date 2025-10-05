<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithoutUrlPagination;

class SalesBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $categories = [];
    public $search = '';
    public $selectedCategory = 0;
    public $selectedType = 'all';
    public $selectedDate = 'this_year';
    public $startDate;

    public function mount(CategoryService $categoryService)
    {
        $this->categories = $categoryService->getAllCategory();
        $this->startDate = $this->startDate = now()->startOfYear()->toDateString();
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

    public function updated($property)
    {
        if (in_array($property, ['selectedCategory', 'search', 'selectedType'])) {
            $this->gotoPage(1);
        }
    }

    public function getSales($type)
    {
        $orders = Order::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')->get();
        $total = 0;
        foreach($orders as $order){
            $total += $order->total_amount;
        }
        return $total;
    }

    public function getTransaction($type)
    {
        return count(Order::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')->get());
    }

    public function exportSales()
    {
        return redirect()->to(route('export.sales', ['startDate' => $this->startDate]));
    }

    public function render(ProductService $productService)
    {
        $products = $productService->getSortedSales($this->startDate, $this->selectedType, $this->selectedCategory, $this->search);

        return view('livewire.sales-browser', [
            'products' => $products,
        ]);
    }
}
