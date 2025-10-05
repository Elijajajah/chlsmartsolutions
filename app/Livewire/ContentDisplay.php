<?php

namespace App\Livewire;

use Livewire\Component;

class ContentDisplay extends Component
{
    public $items = [];
    public $active = '';

    protected $listeners = ['setActive' => 'updateActive'];

    public function mount($items = [])
    {
        $this->items = $items;
        $this->active = session('sidebar_active', $items[0]['label'] ?? '');
    }

    public function updateActive($option)
    {
        $this->active = $option;
    }

    public function render()
    {
        return view('livewire.content-display');
    }
}

