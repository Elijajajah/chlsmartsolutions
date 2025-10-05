<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\TaskService;
use App\Services\UserService;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class TaskForm extends Component
{
    public $title = null;
    public $priority = null;
    public $expiry_date = null;
    public $user_id = null;
    public $customer_name = null;
    public $customer_phone = null;
    public $description = '';


    public function render(UserService $userService)
    {
        $technicians = $userService->getAvailableTechnician();

        return view('livewire.task-form', [
            'technicians' => $technicians
        ]);
    }

    public function createTask()
    {
        try {
            $validator = $this->validate([
                'title' => 'required',
                'priority' => 'required',
                'expiry_date' => 'nullable|date|after_or_equal:today',
                'user_id' => 'required|exists:users,id',
                'customer_name' => 'required',
                'customer_phone' => 'required|regex:/^9[0-9]{9}$/',
                'description' => 'nullable',
            ], [
                'title.required' => 'The task title is required.',
                'priority.required' => 'Please select a priority level.',
                'expiry_date.after_or_equal' => 'The expiration date cannot be earlier than today.',
                'user_id.required' => 'Please assign a technician.',
                'user_id.exists' => 'The selected technician is invalid or does not exist.',
                'customer_name.required' => 'Customer name is required.',
                'customer_phone.required' => 'Customer phone number is required.',
                'customer_phone.regex' => 'Customer phone must start with 9 and contain exactly 10 digits (e.g., 9123456789).',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $task = app(TaskService::class)->createTask($validator, true);

        app(NotificationService::class)->createNotif(
            $task->user_id,
            "Task Created Successfully",
            'The task titled "' . Str::title($task->title) . '" requested by ' . $task->customer_name . ' has been created successfully.',
            ['technician'],
        );

        notyf()->success('Task created successfully');

        return redirect()->route('landing.page');
    }
}
