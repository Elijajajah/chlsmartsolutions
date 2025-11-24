<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Order;
use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ProductService;
use App\Services\CategoryService;
use Livewire\WithoutUrlPagination;

class SalesBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $categories = [], $serviceCategories = [];
    public $search = '';
    public $selectedCategory = 0;
    public $selectedType = 'all';
    public $selectedDate = 'this_year';
    public $startDate;
    public $taskSearch = '';
    public $selectedTaskCategory = 0;
    public $selectedTaskType = 'all';

    public function mount(CategoryService $categoryService)
    {
        $this->categories = $categoryService->getAllCategory();
        $this->serviceCategories = ServiceCategory::all();
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
        // Orders total
        $ordersTotal = Order::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->sum('total_amount');

        // Tasks total
        $tasksTotal = Task::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->sum('price');

        return $ordersTotal + $tasksTotal;
    }

    public function getTransaction($type)
    {
        // Orders count
        $ordersCount = Order::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->count();

        // Tasks count
        $tasksCount = Task::where('type', $type)
            ->whereBetween('updated_at', [$this->startDate, now()])
            ->where('status', 'completed')
            ->count();

        return $ordersCount + $tasksCount;
    }

    public function exportSalesServices()
    {
        return redirect()->to(route('export.sales.services', ['startDate' => $this->startDate]));
    }

    public function render(ProductService $productService)
    {
        $products = $productService->getSortedSales($this->startDate, $this->selectedType, $this->selectedCategory, $this->search);
        $tasks = Task::with(['service.serviceCategory', 'user'])
            ->where('status', 'completed')
            ->when($this->startDate, fn($q) => $q->whereBetween('updated_at', [$this->startDate, now()]))
            ->when($this->selectedTaskType !== 'all', fn($q) => $q->where('type', $this->selectedTaskType))
            ->when($this->selectedTaskCategory != 0, fn($q) => $q->whereHas('service', fn($q2) => $q2->where('service_category_id', $this->selectedTaskCategory)))
            ->when($this->taskSearch !== '', fn($q) => $q->where(function ($q2) {
                $q2->where('customer_name', 'like', "%{$this->taskSearch}%")
                    ->orWhereHas('service', fn($q3) => $q3->where('service', 'like', "%{$this->taskSearch}%"));
            }))
            ->orderBy('updated_at', 'asc')
            ->paginate(8);


        return view('livewire.sales-browser', [
            'products' => $products,
            'tasks' => $tasks,
        ]);
    }
}
