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
use App\Models\User;
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
    public $filteredServices = [];
    public $showAddTask = false, $newAddTechnician = '', $newAddCategory = '', $newAddService = '', $newAddPriority = '', $newAddDue = '', $newAddFullName = '', $newAddPhoneNumber = '', $newAddDescription = '';
    public $showEditTask = false, $editTaskId = null, $newEditTechnician = '', $newEditCategory = '', $newEditService = '', $newEditPriority = '', $newEditDue = '', $newEditFullName = '', $newEditPhoneNumber = '', $newEditDescription = '';
    public $catName = '', $newCatName = '', $catEditingId = null;
    public $searchService = '', $showAddModal = false, $newServiceName = '', $newCategory = '', $newAmount = 0.00;
    public $showEditModal = false, $editServiceId = null, $editServiceName = '', $editServiceCategory = '', $editAmount = 0;
    public string $activeTab = 'taskBrowse';

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

    public function closeAddTask()
    {
        $this->reset(['newAddTechnician', 'filteredServices', 'newAddCategory', 'newAddService', 'newAddPriority', 'newAddDue', 'newAddFullName', 'newAddPhoneNumber', 'newAddDescription']);
        $this->showAddTask = false;
    }

    public function closeEditTask()
    {
        $this->reset('filteredServices');
        $this->showEditTask = false;
    }

    public function editTask($id)
    {
        $task = Task::find($id);
        $this->editTaskId = $id;
        $this->newEditTechnician = $task->user_id ?? '';
        $this->newEditCategory = optional($task->service)->service_category_id;
        $this->updatedNewEditCategory($this->newEditCategory);
        $this->newEditService = $task->service_id;
        $this->newEditPriority = $task->priority;
        $this->newEditDue = $task->expiry_date ?? '';
        $this->newEditFullName = $task->customer_name;
        $this->newEditPhoneNumber = $task->customer_phone;
        $this->newEditDescription = $task->description;
        $this->showEditTask = true;
    }

    public function saveEditTask()
    {
        try {
            $this->validate([
                'newEditTechnician' => 'required|exists:users,id',
                'newEditCategory' => 'required|exists:service_categories,id',
                'newEditService' => 'required|exists:services,id',
                'newEditPriority' => 'required|in:low,medium,high',
                'newEditDue' => 'required|date|after_or_equal:today',
                'newEditFullName' => 'required|string|max:255',
                'newEditPhoneNumber' => 'required|regex:/^9[0-9]{9}$/',
                'newEditDescription' => 'nullable|string',
            ], [
                'newEditTechnician.required' => 'Please select a technician.',
                'newEditTechnician.exists' => 'The selected technician is invalid or does not exist.',
                'newEditCategory.required' => 'Please select a service category.',
                'newEditCategory.exists' => 'The selected category is invalid.',
                'newEditService.required' => 'Please select a service.',
                'newEditService.exists' => 'The selected service is invalid.',
                'newEditPriority.required' => 'Please select a priority level.',
                'newEditPriority.in' => 'The selected priority is invalid.',
                'newEditDue.required' => 'Please set a due date.',
                'newEditDue.after_or_equal' => 'The due date cannot be earlier than today.',
                'newEditFullName.required' => 'Customer full name is required.',
                'newEditPhoneNumber.required' => 'Customer phone number is required.',
                'newEditPhoneNumber.regex' => 'Customer phone must start with 9 and contain exactly 10 digits (e.g., 9123456789).',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $task = Task::find($this->editTaskId);

        if (!$task) {
            notyf()->error('Task not found.');
            return;
        }

        $task->update([
            'user_id' => $this->newEditTechnician,
            'service_id' => $this->newEditService,
            'priority' => $this->newEditPriority,
            'expiry_date' => $this->newEditDue,
            'customer_name' => $this->newEditFullName,
            'customer_phone' => $this->newEditPhoneNumber,
            'description' => $this->newEditDescription,
        ]);

        notyf()->success('Task updated successfully.');
        $this->closeEditTask();
    }


    public function createTask()
    {
        try {
            $this->validate([
                'newAddTechnician' => 'nullable|exists:users,id',
                'newAddCategory' => 'required|exists:service_categories,id',
                'newAddService' => 'required|exists:services,id',
                'newAddPriority' => 'required|in:low,medium,high',
                'newAddDue' => 'required|date|after_or_equal:today',
                'newAddFullName' => 'required|string|max:255',
                'newAddPhoneNumber' => 'required|regex:/^9[0-9]{9}$/',
                'newAddDescription' => 'nullable|string',
            ], [
                'newAddTechnician.exists' => 'The selected technician is invalid or does not exist.',
                'newAddCategory.required' => 'Please select a service category.',
                'newAddCategory.exists' => 'The selected category is invalid.',
                'newAddService.required' => 'Please select a service.',
                'newAddService.exists' => 'The selected service is invalid.',
                'newAddPriority.required' => 'Please select a priority level.',
                'newAddPriority.in' => 'The selected priority is invalid.',
                'newAddDue.required' => 'Please set a due date.',
                'newAddDue.after_or_equal' => 'The due date cannot be earlier than today.',
                'newAddFullName.required' => 'Customer full name is required.',
                'newAddPhoneNumber.required' => 'Customer phone number is required.',
                'newAddPhoneNumber.regex' => 'Customer phone must start with 9 and contain exactly 10 digits (e.g., 9123456789).',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        // Determine task status
        $status = $this->newAddTechnician ? 'pending' : 'unassigned';

        // Create task
        $task = Task::create([
            'service_id' => $this->newAddService,
            'priority' => $this->newAddPriority,
            'description' => $this->newAddDescription,
            'customer_name' => $this->newAddFullName,
            'customer_phone' => $this->newAddPhoneNumber,
            'user_id' => $this->newAddTechnician ?: null,
            'status' => $status,
            'expiry_date' => $this->newAddDue,
        ]);

        // Create technician notification (if assigned)
        if ($this->newAddTechnician) {
            app(NotificationService::class)->createNotif(
                $task->user_id,
                "New Task Assigned",
                'A new task for "' . Str::title(optional($task->service)->service ?? 'Unknown Service') . '" has been assigned to you. Please check your task list for details.',
                ['technician'],
            );
        }

        notyf()->success('Task created successfully.');
        $this->closeAddTask();
    }

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

    public function mount()
    {
        $this->filteredServices = collect();
    }

    public function updatedNewAddCategory($categoryId)
    {
        if (!empty($categoryId)) {
            $this->filteredServices = Service::where('service_category_id', $categoryId)->get();
        } else {
            $this->filteredServices = collect(); // reset
        }

        $this->newAddService = '';
    }

    public function updatedNewEditCategory($categoryId)
    {
        if (!empty($categoryId)) {
            $this->filteredServices = Service::where('service_category_id', $categoryId)->get();
        } else {
            $this->filteredServices = collect();
        }

        $this->newEditService = '';
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
        $technicians = User::with('technicianRole')
            ->where('role', 'technician')
            ->where('status', 'active')
            ->get();
        return view('livewire.task-browser', [
            'tasks' => $tasks,
            'taskCount' => $taskCount,
            'allserviceCategories' => $allserviceCategories,
            'allServices' => $allService,
            'services' => $services,
            'serviceCategories' => $serviceCategories,
            'pendingTaskCount' => $pendingTask,
            'technicians' => $technicians,
        ]);
    }
}
