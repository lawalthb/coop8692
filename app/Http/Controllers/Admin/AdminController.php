<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = User::where('is_admin', true)
            ->latest()
            ->paginate(15);
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request)
    {
        User::create([
            'title' => $request->title,
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'othername' => $request->othername,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'is_approved' => true,
            'member_no' => 'ADM' . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin created successfully');
    }

    public function edit(User $admin)
    {
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(AdminRequest $request, User $admin)
    {
        $admin->update($request->validated());
        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin updated successfully');
    }
}
