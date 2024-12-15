<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('member.profile.index', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();

        if ($request->hasFile('signature_image')) {
            $path = $request->file('signature_image')->store('signatures', 'public');
            $data['signature_image'] = $path;
        }

        if ($request->hasFile('member_image')) {
            $path = $request->file('member_image')->store('members', 'public');
            $data['member_image'] = $path;
        }

        $user->update($data);

        return redirect()->route('member.profile.index')
            ->with('success', 'Profile updated successfully');
    }
}
