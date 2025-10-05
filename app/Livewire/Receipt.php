<?php

namespace App\Livewire;

use Livewire\Component;

class Receipt extends Component
{
    public function clearSession()
    {
        session()->forget(['showCard', 'orderId', 'total', 'referenceId']);
    }

    public function render()
    {
        return view('livewire.receipt');
    }
}
