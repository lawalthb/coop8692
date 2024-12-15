<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMember;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'surname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'othername' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'title' => $validated['title'],
            'surname' => $validated['surname'],
            'firstname' => $validated['firstname'],
            'othername' => $validated['othername'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
            'member_no' => 'COOP' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
        ]);

        Mail::to($user->email)->send(new WelcomeMember($user));

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
}
