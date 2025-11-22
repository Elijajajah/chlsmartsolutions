<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;

class NotificationList extends Component
{
    public $notifications;
    public $selectedMessage = 0;


    public function mount(NotificationService $notificationService)
    {
        $this->loadNotifications($notificationService);
    }

    public function loadNotifications(NotificationService $notificationService)
    {
        $this->notifications = $notificationService->getFilteredNotification(Auth::id(), $this->selectedMessage);
    }

    public function markAsRead($id, NotificationService $notificationService)
    {
        $user = Auth::user();
        $user->notifications()->updateExistingPivot($id, ['read_at' => now()]);

        $this->dispatch('notificationRead')->to('sidebar');
        $this->loadNotifications($notificationService);
    }

    public function markAllAsRead(NotificationService $notificationService)
    {
        $user = Auth::user();
        $user->notifications()->wherePivot('read_at', null)
            ->update(['notification_users.read_at' => now()]);

        $this->dispatch('notificationRead')->to('sidebar');
        $this->loadNotifications($notificationService);
    }

    public function render(NotificationService $notificationService)
    {
        $this->loadNotifications($notificationService);
        return view('livewire.notification-list');
    }

    public function updatedSelectedMessage(NotificationService $notificationService)
    {
        $this->loadNotifications($notificationService);
    }
}
