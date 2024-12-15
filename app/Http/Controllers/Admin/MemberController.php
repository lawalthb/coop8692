<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\MemberUpdateRequest;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('is_admin', false)
            ->with(['state', 'lga'])
            ->latest()
            ->paginate(15);
        return view('admin.members.index', compact('members'));
    }

    public function show(User $member)
    {
        $member->load(['state', 'lga', 'loans', 'transactions']);
        return view('admin.members.show', compact('member'));
    }

    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(MemberUpdateRequest $request, User $member)
    {
        $member->update($request->validated());
        return redirect()->route('admin.members.show', $member)
            ->with('success', 'Member details updated successfully');
    }

    public function approve(User $member)
    {
        $member->update([
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => auth()->id()
        ]);

        return redirect()->route('admin.members.show', $member)
            ->with('success', 'Member approved successfully');
    }
}
