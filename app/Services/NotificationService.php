<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function createNotif($id, $title, $message, $visible_to)
    {
        Notification::create([
            'user_id' => $id,
            'title' => $title,
            'message' => $message,
            'visible_to' => $visible_to,
        ]);
    }

    public function getFilteredNotification($id ,$filter, $role)
    {
        $query = match ($role) {
            'technician' => Notification::where('user_id', $id),
            default => Notification::whereJsonContains('visible_to', $role),
        };

        if ($filter == 1) {
            $query->whereNull('read_at');
        } elseif ($filter == 2) {
            $query->whereNotNull('read_at');
        }

        return $query->latest()->take(10)->get();
    }
}
