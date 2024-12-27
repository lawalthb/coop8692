<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfileUpdateRequest;
use App\Notifications\ProfileUpdateRequestStatusNotification;
use Illuminate\Http\Request;
use App\Models\User;



class ProfileUpdateRequestController extends Controller
{
    public function index()
    {
        $requests = ProfileUpdateRequest::with('user')
            ->latest()
            ->paginate(10);

        return view('admin.profile-updates.index', compact('requests'));
    }

    public function show(ProfileUpdateRequest $request)
    {
        return view('admin.profile-updates.show', compact('request'));
    }

    public function approve(Request $request, ProfileUpdateRequest $profileRequest)
    {
        // dd($profileRequest->user_id)
        $user = User::findOrFail($request->user_id);
        $profileRequest = ProfileUpdateRequest::findOrFail($request->profile_request_id);

        // Get only the non-null values from ProfileUpdateRequest
        $updatedFields = collect([
            'title',
            'surname',
            'firstname',
            'othername',
            'home_address',
            'gender',
            'phone_number',
            'email',
            'dob',
            'nationality',
            'state_id',
            'lga_id',
            'nok',
            'nok_relationship',
            'nok_address',
            'marital_status',
            'religion',
            'nok_phone',
            'monthly_savings'
        ])->mapWithKeys(function ($field) use ($profileRequest) {
            return [$field => $profileRequest->$field];
        })->filter()->toArray();

        // Update user profile with requested changes
        $user->update($updatedFields);

        // Update images if provided
        if ($profileRequest->member_image) {
            $user->member_image = $profileRequest->member_image;
        }
        if ($profileRequest->signature_image) {
            $user->signature_image = $profileRequest->signature_image;
        }
        $user->save();

        // Update request status
        $profileRequest->update([
            'status' => 'approved',
            'admin_remarks' => $request->admin_remarks
        ]);

        $profileRequest->user->notify(new ProfileUpdateRequestStatusNotification('approved', $request->admin_remarks));

        return redirect()->route('admin.profile-updates.index')
            ->with('success', 'Profile update request approved successfully');
    }





    public function reject(Request $request, ProfileUpdateRequest $profileRequest)
    {
        $profileRequest->update([
            'status' => 'rejected',
            'admin_remarks' => $request->admin_remarks
        ]);
        $profileRequest->user->notify(new ProfileUpdateRequestStatusNotification('rejected', $request->admin_remarks));

        return redirect()->route('admin.profile-updates.index')
            ->with('success', 'Profile update request rejected');
    }
}
