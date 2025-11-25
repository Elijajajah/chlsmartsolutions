<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\User;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\Services\UserService;
use App\Models\ServiceCategory;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class TaskBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 'all';
    public $selectedDate = 'today';
    public $searchCat = '';
    public $selectedCategory = 'all';
    public $filteredServices = [];
    public $showAddTask = false, $newAddTechnician = '', $newAddCategory = '', $newAddService = '', $newAddType = '', $newAddPaymentMethod = '', $newAddTax = '', $newAddFullName = '', $newAddPhoneNumber = '', $newAddDescription = '', $newAddPrice = '';
    public $showEditTask = false, $editTaskId = null, $newEditTechnician = '', $newEditCategory = '', $newEditService = '', $newEditType = '', $newEditPaymentMethod = '', $newEditTax = '', $newEditFullName = '', $newEditPhoneNumber = '', $newEditDescription = '', $newEditPrice = '', $newEditTotalPrice = '';
    public $catName = '', $newCatName = '', $catEditingId = null;
    public $searchService = '', $showAddModal = false, $newServiceName = '', $newCategory = '';
    public $showEditModal = false, $editServiceId = null, $editServiceName = '', $editServiceCategory = '';
    public $images = [];
    public string $activeTab = 'taskBrowse';
    public $previewImage = null;

    public function openPreview($path)
    {
        $this->previewImage = $path;
    }

    public function closePreview()
    {
        $this->previewImage = null;
    }

    public function closeAddTask()
    {
        $this->reset(['newAddTechnician', 'filteredServices', 'newAddCategory', 'newAddService', 'newAddType', 'newAddTax', 'newAddPaymentMethod', 'newAddFullName', 'newAddPhoneNumber', 'newAddDescription',]);
        $this->showAddTask = false;
    }

    public function closeEditTask()
    {
        $this->reset('filteredServices');
        $this->showEditTask = false;
    }

    public function editTask($id)
    {
        $task = Task::with('images')->find($id);
        $this->editTaskId = $id;
        $this->images = $task->images;
        $this->newEditTechnician = $task->technician_id ?? '';
        $this->newEditCategory = optional($task->service)->service_category_id;
        $this->updatedNewEditCategory($this->newEditCategory);
        $this->newEditService = $task->service_id;
        $this->newEditFullName = $task->customer_name;
        $this->newEditPhoneNumber = $task->customer_phone;
        $this->newEditType = $task->type;
        $this->newEditPaymentMethod = $task->payment_method;
        $this->newEditTax = $task->tax;
        $this->newEditTotalPrice = $task->price;
        $this->newEditPrice = round($this->newEditTotalPrice / (1 + $this->newEditTax / 100), 2);
        $this->newEditDescription = $task->description;
        $this->showEditTask = true;
    }

    public function saveEditTask()
    {
        if ($this->newEditTax == 0) {
            $this->newEditTax = null;
        }
        try {
            $this->validate([
                'newEditTechnician' => 'required|exists:users,id',
                'newEditCategory' => 'required|exists:service_categories,id',
                'newEditService' => 'required|exists:services,id',
                'newEditFullName' => 'required|string|max:255',
                'newEditPhoneNumber' => 'required|regex:/^9[0-9]{9}$/',
                'newEditType' => 'required|in:online,walk_in,project_based,government',
                'newEditPaymentMethod' => 'required|in:cheque,bank_transfer,ewallet,cash',
                'newEditTax' => 'required_if:newEditType,government|numeric|nullable|min:1',
                'newEditPrice' => 'required|min:0',
                'newEditDescription' => 'nullable|string',
            ], [
                'newEditTechnician.required' => 'Please select a technician.',
                'newEditTechnician.exists' => 'The selected technician is invalid or does not exist.',
                'newEditCategory.required' => 'Please select a service category.',
                'newEditCategory.exists' => 'The selected category is invalid.',
                'newEditService.required' => 'Please select a service.',
                'newEditService.exists' => 'The selected service is invalid.',
                'newEditType.required' => 'Please select a service type.',
                'newEditType.in' => 'The selected service type is invalid.',
                'newEditPaymentMethod.required' => 'Please select a payment method.',
                'newEditPaymentMethod.in' => 'The selected payment method is invalid.',
                'newEditTax.required_if' => 'Tax is required for government customers.',
                'newEditTax.min' => 'Tax cannot be less than 1.',
                'newEditPrice.required' => 'Price is required.',
                'newEditPrice.min' => 'Price cannot be negative.',
                'newEditFullName.required' => 'Customer full name is required.',
                'newEditPhoneNumber.required' => 'Customer phone number is required.',
                'newEditPhoneNumber.regex' => 'Customer phone must start with 9 and contain exactly 10 digits (e.g., 9123456789).',
                'newAddTax.required_if' => 'Tax is required for government customers.',
            ]);
        } catch (ValidationException $e) {
            notyf()->error($e->validator->errors()->first());
            return;
        }

        $task = Task::find($this->editTaskId);

        if (!$task) {
            notyf()->error('Task not found.');
            return;
        }

        // Store old technician for comparison
        $oldTechnician = $task->user_id;
        $newTechnician = $this->newEditTechnician;

        // Update the task
        $task->update([
            'technician_id' => $newTechnician,
            'service_id' => $this->newEditService,
            'customer_name' => $this->newEditFullName,
            'customer_phone' => $this->newEditPhoneNumber,
            'description' => $this->newEditDescription,
            'type' => $this->newEditType,
            'payment_method' => $this->newEditPaymentMethod,
            'tax' => $this->newEditTax ?: 0,
            'price' => floatval($this->newEditPrice) * (1 + floatval($this->newEditTax ?: 0) / 100),
            'status' => 'pending',
        ]);

        // Notifications only if technician changed
        if ($oldTechnician !== $newTechnician) {

            // Notify the old technician
            if ($oldTechnician) {
                app(NotificationService::class)->createNotif(
                    "Task Reassigned",
                    'A task for "' . Str::title(optional($task->service)->service ?? 'Unknown Service') . '" has been reassigned to another technician.',
                    null,
                    $oldTechnician
                );
            }

            // Notify the new technician
            if ($newTechnician) {
                app(NotificationService::class)->createNotif(
                    "New Task Assigned",
                    'A new task for "' . Str::title(optional($task->service)->service ?? 'Unknown Service') . '" has been assigned to you. Please check your task list.',
                    null,
                    $newTechnician
                );
            }
        }

        notyf()->success('Task updated successfully.');
        $this->closeEditTask();
    }

    public function updatedNewEditPrice()
    {
        $this->updateTotalPrice();
    }

    public function updatedNewEditTax()
    {
        $this->updateTotalPrice();
    }

    public function updatedNewEditType()
    {
        $this->newEditTax = 0;
        $this->updateTotalPrice();
    }

    public function updateTotalPrice()
    {
        $this->newEditTotalPrice = floatval($this->newEditPrice) * (1 + floatval($this->newEditTax ?: 0) / 100);
    }

    public function createTask()
    {
        try {
            $this->validate(
                [
                    'newAddTechnician' => 'nullable|exists:users,id',
                    'newAddCategory' => 'required|exists:service_categories,id',
                    'newAddService' => 'required|exists:services,id',
                    'newAddType' => 'required|in:walk_in,project_based,government',
                    'newAddPaymentMethod' => 'required|in:cheque,bank_transfer,ewallet,cash',
                    'newAddTax' => 'required_if:newAddType,government|numeric|min:1',
                    'newAddPrice' => 'required|min:0',
                    'newAddFullName' => 'required|string|max:255',
                    'newAddPhoneNumber' => 'required|regex:/^9[0-9]{9}$/',
                    'newAddDescription' => 'nullable|string',
                ],
                [
                    'newAddTechnician.exists' => 'The selected technician is invalid or does not exist.',
                    'newAddCategory.required' => 'Please select a service category.',
                    'newAddCategory.exists' => 'The selected service category is invalid.',
                    'newAddService.required' => 'Please select a service.',
                    'newAddService.exists' => 'The selected service is invalid.',
                    'newAddType.required' => 'Please select a service type.',
                    'newAddType.in' => 'The selected service type is invalid.',
                    'newAddPaymentMethod.required' => 'Please select a payment method.',
                    'newAddPaymentMethod.in' => 'The selected payment method is invalid.',
                    'newAddTax.required_if' => 'Tax is required for government customers.',
                    'newAddTax.min' => 'Tax cannot be less than 1.',
                    'newAddPrice.required' => 'Price is required.',
                    'newAddPrice.min' => 'Price cannot be negative.',
                    'newAddFullName.required' => 'Customer full name is required.',
                    'newAddFullName.max' => 'Customer full name must not exceed 255 characters.',
                    'newAddPhoneNumber.required' => 'Customer phone number is required.',
                    'newAddPhoneNumber.regex' => 'Phone number must start with 9 and contain exactly 10 digits (e.g., 9123456789).',
                ]
            );
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
            'description' => $this->newAddDescription,
            'customer_name' => $this->newAddFullName,
            'customer_phone' => $this->newAddPhoneNumber,
            'type' => $this->newAddType,
            'tax' => $this->newAddTax ?: 0,
            'payment_method' => $this->newAddPaymentMethod,
            'price' => floatval($this->newAddPrice) * (1 + floatval($this->newAddTax ?: 0) / 100),
            'technician_id' => $this->newAddTechnician ?: null,
            'user_id' => Auth::id(),
            'status' => $status,
        ]);

        // Create technician notification (if assigned)
        if ($this->newAddTechnician) {
            app(NotificationService::class)->createNotif(
                "New Task Assigned",
                'A new task for "' . Str::title(optional($task->service)->service ?? 'Unknown Service') . '" has been assigned to you. Please check your task list for details.',
                null,
                $task->user_id,
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

        $cat = ServiceCategory::create([
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
            ], [
                'newServiceName.required' => 'Category name is required.',
                'newCategory.required' => 'Service category is required.',
                'newCategory.exists' => 'Selected service category does not exist.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        Service::create([
            'service' => $this->newServiceName,
            'service_category_id' => $this->newCategory,
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
        $this->showEditModal = true;
    }

    public function editService()
    {
        try {
            $this->validate([
                'editServiceName' => 'required|string',
                'editServiceCategory' => 'required|exists:service_categories,id',
            ], [
                'editServiceName.required' => 'Category name is required.',
                'editServiceCategory.required' => 'Service category is required.',
                'editServiceCategory.exists' => 'Selected service category does not exist.',
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
        $tasks =  $taskService->getFilteredTask($this->selectedStatus, $this->selectedDate);
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
