<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMember;
use App\Models\State;

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
            'state_id' => 'required|exists:states,id',
            'lga_id' => 'required|exists:lgas,id'
        ]);

        $user = User::create([
            'title' => $validated['title'],
            'surname' => $validated['surname'],
            'firstname' => $validated['firstname'],
            'othername' => $validated['othername'],
            'email' => $validated['email'],
            'phone_number' => $validated['phone_number'],
            'password' => Hash::make($validated['password']),
            'state_id' => $validated['state_id'],
            'lga_id' => $validated['lga_id'],
            'member_no' => 'C8692' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
        ]);

        Mail::to($user->email)->send(new WelcomeMember($user));

        return redirect()->route('login')
            ->with('success', 'Registration successful! Please wait for admin approval.');
    }

    public function showRegistrationForm()
    {
        $states = State::where('status', 'active')->get();
        return view('auth.register', compact('states'));
    }
}
