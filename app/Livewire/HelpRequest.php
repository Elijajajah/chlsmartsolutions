<?php

namespace App\Livewire;

use App\Models\Task;
use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ServiceRequestMail;
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
    public $description = '';

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
        $this->reset();
    }

    public function createRequest()
    {
        try {
            $this->validate([
                'selectedService.id' => 'required|exists:services,id',
                'description' => 'nullable|string',
            ], [
                'selectedService.id.required' => 'Please select a service.',
                'selectedService.id.exists' => 'The selected service is invalid.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        // Create task
        Task::create([
            'user_id' => Auth::id(),
            'technician_id' => null,
            'service_id' => $this->selectedService->id,
            'customer_name' => Auth::user()->fullname,
            'customer_phone' => Auth::user()->phone_number,
            'description' => $this->description,
            'tax' => 0,
            'type' => 'online',
        ]);

        Mail::to(Auth::user()->email)->send(
            new ServiceRequestMail(
                $this->selectedService->service,
                Auth::user()->fullname
            )
        );

        app(NotificationService::class)->createNotif(
            "New Task Requested",
            "{$this->selectedService->service} has been requested successfully.",
            ['cashier', 'admin_officer'],
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
