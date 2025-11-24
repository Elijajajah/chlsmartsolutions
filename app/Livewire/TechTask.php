<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\TaskImage;
use App\Models\ActivityLog;
use Livewire\WithPagination;
use App\Services\TaskService;
use Livewire\WithFileUploads;
use Livewire\WithoutUrlPagination;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TechTask extends Component
{
    use WithPagination, WithoutUrlPagination, WithFileUploads;

    public $selectedTask = null;
    public $showModal = false;
    public $selectedDate;
    public $images = [];
    public $existingImages = [];

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function selectTask($task_id)
    {
        $this->images = [];
        $this->existingImages = [];
        $this->showModal = true;
        $this->selectedTask = Task::with('user', 'images')->find($task_id);
        $this->existingImages = $this->selectedTask->images->pluck('path')->toArray();
    }

    public function removeImage($index)
    {
        if (isset($this->images[$index])) {
            array_splice($this->images, $index, 1);
        }
    }

    public function removeExistingImage($index)
    {
        if (isset($this->existingImages[$index])) {
            // Optional: Remove from database immediately
            TaskImage::where('path', $this->existingImages[$index])->delete();

            // Remove from the array so UI updates
            array_splice($this->existingImages, $index, 1);
        }
    }


    public function updateStatus($id, ActivityLogService $activityLogService)
    {
        $task = Task::find($id);

        try {
            $this->validate([
                'images' => 'required|array',
                'images.*' => 'image|mimes:png,jpg,jpeg|max:5120',
            ], [
                'images.required' => 'Please upload at least one image proof.',
                'images.*.image' => 'Each file must be an image.',
                'images.*.mimes' => 'Only PNG and JPG images are allowed.',
                'images.*.max' => 'Each image must not exceed 5MB.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            return notyf()->error($message);
        }

        if (!empty($this->images)) {
            $folder = "task-images/{$id}";
            foreach ($this->images as $file) {
                $path = $file->store($folder, 'public');

                TaskImage::create([
                    'task_id' => $id,
                    'path' => $path,
                ]);
            }
        }

        if ($task->status != 'completed') {
            $task->status = 'completed';
            $task->save();
            $activityLogService->saveLog($id, Auth::user()->id);
            $this->dispatch('notificationRead')->to('sidebar');
            $this->closeModal();
            return;
        }
        notyf()->error('Task already been completed.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedTask = null;
    }

    public function updated($property)
    {
        if ($property === 'selectedDate') {
            $this->gotoPage(1);
        }
    }


    public function render(TaskService $taskService)
    {
        $tasks = $taskService->getTasksByDate(Auth::user()->id, $this->selectedDate);
        $logs = ActivityLog::where('user_id', Auth::user()->id)->latest()->take(10)->get();

        return view('livewire.tech-task', [
            'tasks' => $tasks,
            'logs' => $logs,
        ]);
    }

    public function updatingSelectedDate()
    {
        $this->resetPage();
    }
}
