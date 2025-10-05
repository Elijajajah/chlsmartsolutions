<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\UserService;
use Livewire\WithoutUrlPagination;

class UserBrowser extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $search = '';
    public $selectedRole = 'all';
    public $selectedStatus = 'all';
    public $showModal = false;
    protected $listeners = ['cancel' => 'closeModal'];

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function getStaff($role)
    {
        $userService = app(UserService::class);
        return $userService->countStaff($role);
    }

    public function updateStatus($id)
    {
        $user = User::find($id);

        if ($user->status == 'active') {
            $user->status = 'revoked';
            $user->save();
            notyf()->success('Successfully Revoked the account.');
        } else {
            $user->status = 'active';
            $user->save();
            notyf()->success('Successfully Activated the account.');
        }
    }

    public function render(UserService $userService)
    {
        return view('livewire.user-browser', [
            'users' => $userService->getStaffs($this->search, $this->selectedRole, $this->selectedStatus),
        ]);
    }
}
