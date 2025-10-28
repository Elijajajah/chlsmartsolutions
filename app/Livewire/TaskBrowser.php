<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\Services\UserService;
use App\Models\ServiceCategory;
use Livewire\WithoutUrlPagination;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class TaskBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 'all';
    public $selectedPrio = 'all';
    public $searchCat = '';
    public $selectedCategory = 'all';
    public $catName = '';
    public $newCatName = '';
    public $catEditingId = null;
    public $searchService = '';
    public $showAddModal = false;
    public $showEditModal = false;
    public $newServiceName = '';
    public $newCategory = '';
    public $newAmount = 0.00;
    public $editServiceId = null;
    public $editServiceName = '';
    public $editServiceCategory = '';
    public $editAmount = 0;
    public string $activeTab = 'serviceBrowse';

    // public function updatePriority($task_id, $priority)
    // {
    //     $task = Task::find($task_id);

    //     if ($task) {
    //         $task->priority = $priority;
    //         $task->save();

    //         notyf()->success('Status updated successfully');
    //     }
    // }

    // public function updateAssignedTech($task_id, $user_id)
    // {
    //     $task = Task::find($task_id);

    //     if ($task) {
    //         $oldTechnicianId = $task->user_id;

    //         $task->user_id = $user_id ?: null;
    //         if (!$oldTechnicianId && $task->user_id && $task->status === 'unassigned') {
    //             $task->status = 'pending';
    //         }
    //         $task->save();

    //         if ($task->user_id) {
    //             app(NotificationService::class)->createNotif(
    //                 $task->user_id,
    //                 "Task Assigned Successfully",
    //                 'The task titled "' . Str::title($task->title) . '" requested by ' . $task->customer_name . ' has been assigned to you.',
    //                 ['technician'],
    //             );
    //         }

    //         if ($oldTechnicianId && $oldTechnicianId != $task->user_id) {
    //             app(NotificationService::class)->createNotif(
    //                 $oldTechnicianId,
    //                 "Task Reassigned",
    //                 'The task titled "' . Str::title($task->title) . '" requested by ' . $task->customer_name . ' has been reassigned to another technician.',
    //                 ['technician'],
    //             );
    //         }

    //         notyf()->success('Assigned successfully');
    //     }
    // }

    public function createCategory()
    {
        try {
            $this->validate([
                'catName' => 'required|string|unique:service_categories,category',
            ], [
                'catName.required' => 'Category name is required.',
                'catName.unique' => 'Category name must be unique.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        ServiceCategory::create([
            'category' => $this->catName,
        ]);

        $this->catName = '';

        notyf()->success('Service category created successfully.');
    }

    public function editCategory($id)
    {
        $category = ServiceCategory::find($id);
        if ($this->catEditingId === $id) {
            if ($this->newCatName != $category->category) {
                $category->category = $this->newCatName;
                $category->save();
                notyf()->success('Category is renamed successfully');
            }
            $this->catEditingId = null;
            return;
        } else {
            $this->newCatName = $category->category;
            $this->catEditingId = $id;
        }
    }

    public function removeCategory($id)
    {
        $category = ServiceCategory::find($id);
        $category->delete();
        notyf()->success('Category deleted successfully.');
    }

    public function createService()
    {
        try {
            $this->validate([
                'newServiceName' => 'required|string',
                'newCategory' => 'required|exists:service_categories,id',
                'newAmount' => 'required|min:0',
            ], [
                'newServiceName.required' => 'Category name is required.',
                'newCategory.required' => 'Service category is required.',
                'newCategory.exists' => 'Selected service category does not exist.',
                'newAmount.required' => 'Price is required.',
                'newAmount.min' => 'Price must be at least 0.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        Service::create([
            'service' => $this->newServiceName,
            'service_category_id' => $this->newCategory,
            'price' => $this->newAmount,
        ]);

        notyf()->success('Service created successfully.');
        $this->showAddModal = false;
    }

    public function selectEditService($id)
    {
        $service = Service::find($id);
        $this->editServiceId = $service;
        $this->editServiceName = $service->service;
        $this->editServiceCategory = $service->service_category_id;
        $this->editAmount = $service->price;
        $this->showEditModal = true;
    }

    public function editService()
    {
        try {
            $this->validate([
                'editServiceName' => 'required|string',
                'editServiceCategory' => 'required|exists:service_categories,id',
                'editAmount' => 'required|min:0',
            ], [
                'editServiceName.required' => 'Category name is required.',
                'editServiceCategory.required' => 'Service category is required.',
                'editServiceCategory.exists' => 'Selected service category does not exist.',
                'editAmount.required' => 'Price is required.',
                'editAmount.min' => 'Price must be at least 0.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }
        $service = Service::find($this->editServiceId)->first();
        $service->update([
            'service' => $this->editServiceName,
            'service_category_id' => $this->editServiceCategory,
            'price' => $this->editAmount,
        ]);

        notyf()->success('Service saved successfully.');
        $this->showEditModal = false;
    }

    public function removeService($id)
    {
        $service = Service::find($id);
        $service->delete();
        notyf()->success('Service deleted successfully.');
    }

    public function render(TaskService $taskService, UserService $userService)
    {
        $tasks =  $taskService->getFilteredTask($this->selectedStatus, $this->selectedPrio);
        $taskCount = Task::count();
        $allserviceCategories = ServiceCategory::all();
        $allService = Service::all();
        $services = Service::when($this->searchService, function ($query) {
            $query->where('service', 'like', '%' . $this->searchService . '%');
        })
            ->when($this->selectedCategory !== 'all', function ($query) {
                $query->where('service_category_id', $this->selectedCategory);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $serviceCategories = ServiceCategory::when($this->searchCat, function ($query) {
            $query->where('category', 'like', '%' . $this->searchCat . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        $pendingTask = Task::where('status', 'pending')->count();
        return view('livewire.task-browser', [
            'tasks' => $tasks,
            'taskCount' => $taskCount,
            'allserviceCategories' => $allserviceCategories,
            'allServices' => $allService,
            'services' => $services,
            'serviceCategories' => $serviceCategories,
            'pendingTaskCount' => $pendingTask,
        ]);
    }
}
