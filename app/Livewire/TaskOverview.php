<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;

class TaskOverview extends Component
{
    public $active = '';
    public $take = 2;

    public function mount($take = 2)
    {
        $this->take = $take;
    }

    public function setActive($option)
    {
        $this->active = $option;
        session()->put('sidebar_active', $option);
        $this->dispatch('activate', $option)->to('sidebar');
    }

    public function render()
    {
        $tasks = Task::with('service')
            ->whereDate('created_at', '<=', now())
            ->where('status', 'pending')
            ->take($this->take)
            ->get();

        return view('livewire.task-overview', [
            'tasks' => $tasks
        ]);
    }
}
