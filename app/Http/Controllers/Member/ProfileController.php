<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $data = [
            'user' => auth()->user(),
            'states' => State::where('status', 'active')->get()
        ];

        return view('member.profile.show', compact('data'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'phone_number' => ['required', 'string', Rule::unique('users')->ignore($user->id)],
            'home_address' => 'required|string',
            'state_id' => 'required|exists:states,id',
            'lga_id' => 'required|exists:lgas,id',
            'nok' => 'required|string',
            'nok_relationship' => 'required|string',
            'nok_phone' => 'required|string',
            'nok_address' => 'required|string'
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }
}
