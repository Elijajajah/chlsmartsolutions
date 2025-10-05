<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use App\Services\TaskService;
use App\Services\UserService;
use Livewire\WithoutUrlPagination;
use App\Services\NotificationService;

class TaskBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $selectedStatus = 'all';
    public $selectedPrio = 'all';
    public string $activeTab = 'taskBrowse';

    public function getTask($status = null)
    {
        $taskService = app(TaskService::class);
        return $taskService->countTask($status);
    }

    public function updatePriority($task_id, $priority)
    {
        $task = Task::find($task_id);

        if ($task) {
            $task->priority = $priority;
            $task->save();

            notyf()->success('Status updated successfully');
        }
    }

    public function updateAssignedTech($task_id, $user_id)
    {
        $task = Task::find($task_id);

        if ($task) {
            $oldTechnicianId = $task->user_id;

            $task->user_id = $user_id ?: null;
            if (!$oldTechnicianId && $task->user_id && $task->status === 'unassigned') {
                $task->status = 'pending';
            }
            $task->save();

            if ($task->user_id) {
                app(NotificationService::class)->createNotif(
                    $task->user_id,
                    "Task Assigned Successfully",
                    'The task titled "' . Str::title($task->title) . '" requested by ' . $task->customer_name . ' has been assigned to you.',
                    ['technician'],
                );
            }

            if ($oldTechnicianId && $oldTechnicianId != $task->user_id) {
                app(NotificationService::class)->createNotif(
                    $oldTechnicianId,
                    "Task Reassigned",
                    'The task titled "' . Str::title($task->title) . '" requested by ' . $task->customer_name . ' has been reassigned to another technician.',
                    ['technician'],
                );
            }

            notyf()->success('Assigned successfully');
        }
    }


    public function render(TaskService $taskService, UserService $userService)
    {
        $technicians = $userService->getAvailableTechnician();

        $tasks =  $taskService->getFilteredTask($this->selectedStatus, $this->selectedPrio);

        return view('livewire.task-browser', [
            'tasks' => $tasks,
            'technicians' => $technicians,
        ]);
    }
}
