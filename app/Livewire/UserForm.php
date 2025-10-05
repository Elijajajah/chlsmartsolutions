<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\TechnicianRole;
use Illuminate\Support\Facades\Hash;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;

class UserForm extends Component
{
    public $fullname;
    public $username;
    public $phone_number;
    public $password;
    public $role;

    public function cancel()
    {
        $this->dispatch('cancel')->to('user-browser');
    }

    public function createStaff()
    {
        try {
            $this->validate([
                'fullname' => 'required|max:35|regex:/^[A-Za-z\s]+$/',
                'username' => 'required|unique:users,username|min:8|max:25',
                'phone_number' => 'required|regex:/^9[0-9]{9}$/|unique:users,phone_number',
                'password' => 'required|min:8|max:25',
                'role' => 'required',
            ], [
                'fullname.required' => 'Full name is required.',
                'fullname.max' => 'Full name must not exceed 35 characters.',
                'fullname.regex' => 'Full name must contain letters and spaces only.',
                'username.required' => 'Username is required.',
                'username.min' => 'Username must be at least 8 characters.',
                'username.max' => 'Username must not exceed 25 characters.',
                'username.unique' => 'Username has already been used.',
                'phone.required' => 'Phone number is required.',
                'phone.regex' => 'Phone number must start with 9 and contain exactly 10 digits.',
                'phone.unique' => 'Phone number has already been used.',
                'password.required' => 'Password is required.',
                'password.min' => 'Password must be at least 8 characters.',
                'password.max' => 'Password must not exceed 25 characters.',
                'role.required' => 'Role is required.',
            ]);
        } catch (ValidationException $e) {
            $message = $e->validator->errors()->first();
            notyf()->error($message);
            return;
        }

        $isTechnician = str_starts_with($this->role, 'technician');
        $userRole = $isTechnician ? 'technician' : $this->role;

        $user = User::create([
            'fullname' => $this->fullname,
            'username' => $this->username,
            'phone_number' => $this->phone_number,
            'password' => Hash::make($this->password),
            'role' => $userRole,
        ]);

        if ($isTechnician) {
            $techRole = str_contains($this->role, 'main') ? 'main' : 'support';
            TechnicianRole::create([
                'user_id' => $user->id,
                'role' => $techRole,
            ]);
        }

        notyf()->success('Staff created successfully.');
        $role = match ($user->role) {
            'admin-officer' => 'Admin Officer',
            'cashier' => 'Cashier',
            'technician' => 'Technician',
        };

        app(NotificationService::class)->createNotif(
                    $user->id,
                    "Staff Registered Successfully",
                    "{$user->fullname} has been registered as {$role} successfully.",
                    ['admin', 'cashier', 'admin_officer'],
                );

        return redirect()->route('landing.page');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
