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
        $this->notifications = $notificationService->getFilteredNotification(Auth::user()->id, $this->selectedMessage, Auth::user()->role);
    }

    public function markAsRead($id, NotificationService $notificationService)
    {
        $notif = Notification::find( $id);
        if (!$notif->read_at) {
            $notif->read_at = now();
            $notif->save();
            $this->dispatch('notificationRead')->to('sidebar');
        }
        $this->loadNotifications($notificationService);
    }

    public function markAllAsRead(NotificationService $notificationService)
    {
        $query = Auth::user()->role === 'technician'
            ? Notification::where('user_id', Auth::id())
            : Notification::whereJsonContains('visible_to', Auth::user()->role);

        $query->whereNull('read_at')->update(['read_at' => now()]);

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
