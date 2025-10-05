<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\WithPagination;
use App\Services\TaskService;
use Livewire\WithoutUrlPagination;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Auth;

class TechTask extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $selectedPrio = 'all';
    public $selectedTask = null;
    public $showModal = false;
    public $selectedDate;

    public function mount()
    {
        $this->selectedDate = now()->format('Y-m-d');
    }

    public function selectTask($task_id)
    {
        $this->showModal = true;
        $this->selectedTask = Task::with('user')->find($task_id);
    }

    public function updateStatus($id, ActivityLogService $activityLogService)
    {
        $task = Task::find($id);
        if ($task->status != 'completed'){
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
        if ($property === 'selectedDate' || $property === 'selectedPrio') {
            $this->gotoPage(1);
        }
    }


    public function render(TaskService $taskService)
    {
        $tasks = $taskService->getTasksByDate(Auth::user()->id, $this->selectedDate, $this->selectedPrio);
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
