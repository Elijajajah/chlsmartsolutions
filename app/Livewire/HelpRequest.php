<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class HelpRequest extends Component
{
    public $category = 'all';
    public $search = '';
    public $selectedService = null;
    public $selectedCategory = null;
    public $priority = '', $description = '';

    public function selectService($categoryId, $serviceId)
    {
        if (!Auth::check()) {
            return redirect()->route('signin.page');
        }
        $service = Service::find($serviceId);
        $category = ServiceCategory::find($categoryId);
        $this->selectedService = $service;
        $this->selectedCategory = $category;
    }

    public function closeRequest()
    {
        $this->selectedService = null;
        $this->selectedCategory = null;
    }

    public function createRequest()
    {
        try {
            $this->validate([
                'selectedService.id' => 'required|exists:services,id',
                'priority' => 'required|in:low,medium,high',
                'description' => 'nullable|string',
            ], [
                'selectedService.id.required' => 'Please select a service.',
                'selectedService.id.exists' => 'The selected service is invalid.',
                'priority.required' => 'Please select a priority level.',
                'priority.in' => 'The selected priority is invalid.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        // Create task
        Task::create([
            'service_id' => $this->selectedService->id,
            'priority' => $this->priority,
            'description' => $this->description,
            'customer_name' => Auth::user()->fullname,
            'customer_phone' => Auth::user()->phone_number,
            'user_id' => null,
            'status' => 'unassigned',
            'expiry_date' => null,
        ]);

        app(NotificationService::class)->createNotif(
            Auth::user()->id,
            "New Task Requested",
            "{$this->selectedService->service} has been requested successfully.",
            ['owner', 'cashier', 'admin_officer'],
        );

        notyf()->success('Service request successfully.');
        $this->closeRequest();
    }

    public function render()
    {
        $categories = ServiceCategory::with('services')
            ->when($this->category && $this->category !== 'all', function ($query) {
                $query->where('id', $this->category);
            })
            ->when($this->search, function ($query) {
                $query->whereHas('services', function ($q) {
                    $q->where('service', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('category')
            ->paginate(6);


        return view('livewire.help-request', compact('categories'));
    }
}
