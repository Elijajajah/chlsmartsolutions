<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public $items = [];
    public $active = '';
    protected $listeners = ['notificationRead' => 'updateUnreadCount', 'activate' => 'setActive'];
    public $unreadNotif;

    public function updateUnreadCount()
    {
        $this->unreadNotif = match (Auth::user()->role) {
            'technician' => Notification::where('user_id', Auth::id())->whereNull('read_at')->count(),
            default => Notification::whereJsonContains('visible_to', Auth::user()->role)->whereNull('read_at')->count(),
        };
    }
    public function mount($items = [])
    {
        $this->updateUnreadCount();
        $this->items = $items;
        $this->active = session('sidebar_active', $items[0]['label'] ?? '');
    }

    public function setActive($option)
    {
        $this->active = $option;
        session()->put('sidebar_active', $option);
        $this->dispatch('setActive', $option);
    }

    public function render()
    {
        $this->updateUnreadCount();
        return view('livewire.sidebar');
    }
}
