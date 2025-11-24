<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Task;

class TaskService
{
    public function getTasksByDate($user_id, $date, $prio)
    {
        $query = Task::with('service')
            ->where('user_id', $user_id)
            ->whereDate('created_at', '<=', $date);

        if ($prio != 'all') {
            $query->where('priority', $prio);
        }

        return $query->paginate(11);
    }


    public function getFilteredTask($status, $date)
    {
        return Task::with('user', 'service.serviceCategory')
            ->when(
                $status && $status !== 'all',
                fn($query) =>
                $query->where('status', $status)
            )
            ->when($date, function ($query) use ($date) {
                if ($date === 'today') {
                    $query->whereDate('created_at', today());
                } elseif ($date === 'this_week') {
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                } elseif ($date === 'this_month') {
                    $query->whereMonth('created_at', now()->month);
                } elseif ($date === 'this_year') {
                    $query->whereYear('created_at', now()->year);
                }
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }
}
