<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\State;
use App\Models\Lga;
use App\Models\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class MemberProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $states = State::orderBy('name')->get();
        $lgas = Lga::orderBy('name')->get();

        return view('member.profile.show', compact('user', 'states', 'lgas'));
    }



    public function updateRequest(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'surname' => 'required',
            'firstname' => 'required',
            'othername' => 'nullable',
            'home_address' => 'required',
            'phone_number' => 'required',
            'dob' => 'required|date',
            'state_id' => 'required|exists:states,id',
            'lga_id' => 'required|exists:lgas,id',
            'religion' => 'required',
            'marital_status' => 'required',
            'member_image' => 'nullable|image|max:2048',
            'signature_image' => 'nullable|image|max:2048',
            'nok' => 'required',
            'nok_relationship' => 'required',
            'nok_phone' => 'required',
            'nok_address' => 'required',
            'occupation' => 'required',
            'hostel_name' => 'nullable',
        ]);

        // Handle file uploads
        if ($request->hasFile('member_image')) {
            $validated['member_image'] = $request->file('member_image')->store('member-images', 'public');
        }

        if ($request->hasFile('signature_image')) {
            $validated['signature_image'] = $request->file('signature_image')->store('signatures', 'public');
        }

        // Create profile update request
        $profileRequest =    ProfileUpdateRequest::create([
            'user_id' => auth()->id(),
            ...$validated,
            'status' => 'pending'
        ]);


        return redirect()->back()->with('success', 'Profile update request submitted successfully');
    }
}
