<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\MemberUpdateRequest;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


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

    public function store(Request $request)
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
            'lga_id' => 'required|exists:lgas,id',
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
            'is_approved' => true,
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'state_id' => $validated['state_id'],
            'lga_id' => $validated['lga_id'],
        ]);

        return redirect()->route('admin.members.index')
        ->with('success', 'Member created successfully');
    }

    public function create()
    {
        $states = State::where('status', 'active')->get();
        return view('admin.members.create', compact('states'));
    }
}
