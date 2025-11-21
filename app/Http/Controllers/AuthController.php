<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\OtpVerificationMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class AuthController
{
    public function userSignin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|max:25',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'Email does not exist.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters.',
            'password.max' => 'Password must not exceed 25 characters.',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();
            notyf()->error($message);
            return redirect()->back()->withInput();
        }

        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
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
            'owner' => redirect()->route('owner'),
            'admin_officer' => redirect()->route('admin_officer'),
            'cashier' => redirect()->route('cashier'),
            'technician' => redirect()->route('technician'),
            default => redirect()->route('landing.page'),
        };
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|max:35|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/^9[0-9]{9}$/|unique:users,phone_number',
            'password' => 'required|min:8|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP temporarily (3 min) with email as key
        Cache::put('signup_otp_' . $request->email, [
            'otp' => $otp,
            'data' => $request->only('fullname', 'email', 'phone', 'password')
        ], now()->addMinutes(3));

        // Send OTP email (use your Mail setup)
        Mail::to($request->email)->send(new OtpVerificationMail($otp));

        return response()->json(['message' => 'OTP sent to your email']);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $cache = Cache::get('signup_otp_' . $request->email);

        if (!$cache || $cache['otp'] != $request->otp) {
            return response()->json(['error' => 'Invalid OTP'], 422);
        }

        $data = $cache['data'];

        // Create user now
        User::create([
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone'],
            'password' => Hash::make($data['password']),
            'role' => 'customer',
        ]);

        // Remove OTP from cache
        Cache::forget('signup_otp_' . $request->email);

        return response()->json(['message' => 'Account created successfully']);
    }
    // public function userSignup(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'fullname' => 'required|max:35|regex:/^[A-Za-z\s]+$/',
    //         'username' => 'required|unique:users,username|min:8|max:25',
    //         'phone' => 'required|regex:/^9[0-9]{9}$/|unique:users,phone_number',
    //         'password' => 'required|min:8|max:25',
    //     ], [
    //         'fullname.required' => 'Full name is required.',
    //         'fullname.max' => 'Full name must not exceed 35 characters.',
    //         'fullname.regex' => 'Full name must contain letters and spaces only.',
    //         'username.required' => 'Username is required.',
    //         'username.min' => 'Username must be at least 8 characters.',
    //         'username.max' => 'Username must not exceed 25 characters.',
    //         'username.unique' => 'Username has already been used.',
    //         'phone.required' => 'Phone number is required.',
    //         'phone.regex' => 'Phone number must start with 9 and contain exactly 10 digits.',
    //         'phone.unique' => 'Phone number has already been used.',
    //         'password.required' => 'Password is required.',
    //         'password.min' => 'Password must be at least 8 characters.',
    //         'password.max' => 'Password must not exceed 25 characters.',
    //     ]);

    //     if ($validator->fails()) {
    //         $message = $validator->errors()->first();
    //         notyf()->error($message);
    //         return redirect()->back()->withInput();
    //     }

    //     User::create([
    //         'fullname' => $request->fullname,
    //         'username' => $request->username,
    //         'phone_number' => $request->phone,
    //         'password' => Hash::make($request->password),
    //         'role' => 'customer',
    //     ]);

    //     notyf()->success('Your account was created successfully.');
    //     return redirect()->route('signin.page');
    // }

    public function userSignout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        notyf()->success('Successfully signed out.');
        return redirect()->route('landing.page');
    }
}
