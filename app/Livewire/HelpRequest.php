<?php

namespace App\Livewire;

use Livewire\Component;

class HelpRequest extends Component
{
    public $service = null;
    public $category = null;
    public $preferredDate;
    public $priority;
    public $details;
    public $showForm = false;

    public function selectService($service, $category)
    {
        $this->service = $service;
        $this->category = $category;
        $this->showForm = true;
    }

    public function render()
    {
        return view('livewire.help-request');
    }
}
