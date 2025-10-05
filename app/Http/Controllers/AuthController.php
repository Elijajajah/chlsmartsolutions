<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController
{
    public function userSignin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => [
                'required',
                'min:8',
                'max:25',
                Rule::exists('users', 'username')->where(function ($query) use ($request) {
                    $query->whereRaw('BINARY username = ?', [$request->username]);
                }),
            ],
            'password' => 'required|min:8|max:25',
        ], [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 8 characters.',
            'username.max' => 'Username must not exceed 25 characters.',
            'username.exists' => 'Username does not exist.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 25 characters.',
        ]);

        if ($validator->fails()){
            $message = $validator->errors()->first();
            notyf()->error($message);
            return redirect()->back()->withInput();
        }

        $user = User::where('username', $request->username)->first();
        if (!Hash::check($request->password, $user->password)){
            notyf()->error('Invalid credentials');
            return redirect()->back()->withInput();
        }

        if ($user->status != 'active') {
            notyf()->error('Account has been disabled');
            return redirect()->back()->withInput();
        }

        Auth::login($user);
        notyf()->success('You\'re now signed in.');

        return match ($user->role) {
            'admin' => redirect()->route('admin'),
            'admin_officer' => redirect()->route('admin_officer'),
            'cashier' => redirect()->route('cashier'),
            'technician' => redirect()->route('technician'),
            default => redirect()->route('landing.page'),
        };
    }

    public function userSignup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:35|regex:/^[A-Za-z\s]+$/',
            'username' => 'required|unique:users,username|min:8|max:25',
            'phone' => 'required|regex:/^9[0-9]{9}$/|unique:users,phone_number',
            'password' => 'required|min:8|max:25',
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
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            notyf()->error($message);
            return redirect()->back()->withInput();
        }

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'phone_number' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        notyf()->success('Your account was created successfully.');
        return redirect()->route('signin.page');
    }

    public function userSignout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        notyf()->success('Successfully signed out.');
        return redirect()->route('landing.page');
    }
}
