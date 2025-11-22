<?php

namespace App\Services;

use App\Models\User;
use App\Models\Notification;

class NotificationService
{
    public function createNotif(string $title, string $message, ?array $roles = null, ?int $userId = null)
    {
        $notification = Notification::create([
            'title' => $title,
            'message' => $message,
        ]);

        if ($userId) {
            $notification->users()->attach($userId);
            return;
        }

        if ($roles) {
            $users = User::whereIn('role', $roles)
                ->where('status', 'active')
                ->pluck('id');
            $notification->users()->attach($users);
        }
    }


    public function getFilteredNotification(int $userId, ?int $filter = null)
    {
        $query = User::find($userId)->notifications();

        if ($filter === 1) {
            $query->wherePivot('read_at', null);
        } elseif ($filter === 2) {
            $query->wherePivot('read_at', '!=', null);
        }

        return $query->latest()->take(10)->get();
    }
}
