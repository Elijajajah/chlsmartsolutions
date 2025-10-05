<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;

class TaskService
{
    public function getTasksByDate($user_id, $date, $prio)
    {
        $query = Task::where('user_id', $user_id)
            ->whereDate('created_at', '<=', $date)
            ->whereDate('expiry_date', '>=', $date);

        if ($prio != 'all') {
            $query->where('priority', $prio);
        }

        return $query->orderBy('expiry_date', 'asc')->paginate(11);
    }


    public function getFilteredTask($status, $prio)
    {
        return Task::with('user')
            ->when($status && $status !== 'all', fn($query) => $query->where('status', $status))
            ->when($prio && $prio !== 'all', fn($query) => $query->where('priority', $prio))
            ->orderBy('expiry_date', 'asc')
            ->paginate(9);
    }

    public function countTask($status = null)
    {
        return match ($status) {
            'completed', 'pending' => Task::where('status', $status)
                ->whereDate('created_at', now())
                ->whereDate('expiry_date', now())
                ->count(),

            'missed' => Task::where('status', 'missed')->count(),

            default => Task::count(),
        };
    }

    public function createTask(array $data, bool $withExpiry = true): Task
    {
        if ($withExpiry) {
            $data['expiry_date'] = $data['expiry_date'] ?? now()->addWeek();
        } else {
            $data['expiry_date'] = null;
        }

        $data['user_id'] = $data['user_id'] ?? null;

        return Task::create($data);
    }
}
