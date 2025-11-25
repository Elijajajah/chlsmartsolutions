<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\TechnicianRole;
use Illuminate\Support\Facades\Hash;
use App\Services\NotificationService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\OtpVerificationMail;

class UserForm extends Component
{
    public $fullname;
    public $email = '';
    public $phone_number;
    public $password;
    public $role;
    public $otpSent = false;
    public $otp;
    public $otpInput = '';

    public function cancel()
    {
        $this->dispatch('cancel')->to('staff-browser');
    }

    public function createStaff()
    {
        try {
            $this->validate([
                'fullname' => 'required|max:35|regex:/^[A-Za-z\s]+$/',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|regex:/^9[0-9]{9}$/|unique:users,phone_number',
                'password' => 'required|min:8|max:25',
                'role' => 'required',
            ], [
                'fullname.required' => 'Full name is required.',
                'fullname.max' => 'Full name must not exceed 35 characters.',
                'fullname.regex' => 'Full name must contain letters and spaces only.',
                'email.required' => 'Email is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.exists' => 'Email does not exist.',
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

        // If OTP not yet sent
        if (!$this->otpSent) {
            $this->otp = rand(100000, 999999); // generate OTP

            // Store OTP temporarily for 3 minutes
            Cache::put('staff_otp_' . $this->email, [
                'otp' => $this->otp,
                'data' => [
                    'fullname' => $this->fullname,
                    'email' => $this->email,
                    'phone' => $this->phone_number,
                    'password' => $this->password,
                    'role' => $this->role,
                ]
            ], now()->addMinutes(3));

            Mail::to($this->email)->send(new OtpVerificationMail($this->otp));

            $this->otpSent = true;
            notyf()->success('OTP sent to staff email. Please enter it to confirm creation.');
            return;
        }

        // OTP has been sent, now verify
        $cache = Cache::get('staff_otp_' . $this->email);
        if (!$cache || $cache['otp'] != $this->otpInput) {
            notyf()->error('Invalid OTP. Staff creation canceled.');
            $this->otpSent = false; // reset
            return;
        }

        $data = $cache['data'];

        $isTechnician = str_starts_with($this->role, 'technician');
        $userRole = $isTechnician ? 'technician' : $this->role;

        $user = User::create([
            'fullname' => $this->fullname,
            'email' => $this->email,
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

        Cache::forget('staff_otp_' . $data['email']);
        notyf()->success('Staff created successfully.');
        $role = match ($user->role) {
            'admin_officer' => 'Admin Officer',
            'cashier' => 'Cashier',
            'technician' => 'Technician',
        };

        app(NotificationService::class)->createNotif(
            "Staff Registered Successfully",
            "{$user->fullname} has been registered as {$role} successfully.",
            ['owner', 'cashier', 'admin_officer'],
        );

        return redirect()->route('landing.page');
    }

    public function render()
    {
        return view('livewire.user-form');
    }
}
