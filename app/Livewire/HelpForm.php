<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class HelpForm extends Component
{
    public $title = '';
    public $priority = '';
    public $description;
    public function createTask()
    {
        if (!Auth::check()) {
            return redirect()->route('signin.page');
        }

        try {
            $this->validate([
                'title'       => 'required',
                'priority'    => 'required',
                'description' => 'nullable',
            ]);
        } catch (ValidationException $e) {
            notyf()->error('Please complete all required fields before submitting your request');
            return;
        }

        $user = Auth::user();

        $task = app(TaskService::class)->createTask([
            'title'          => $this->title,
            'priority'       => $this->priority,
            'description'    => $this->description,
            'customer_name'  => $user->fullname,
            'customer_phone' => $user->phone_number,
            'status' => 'unassigned'
        ], true);

        notyf()->success('Your help/service request has been submitted successfully!');
        return redirect()->route('landing.page');
    }

    public function render()
    {
        return view('livewire.help-form');
    }
}
