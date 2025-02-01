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
        ->where('email', '!=', 'anonymous@coop8692.com')
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
            'title' =>'admin',
            'surname' => $request->surname,
            'firstname' => $request->firstname,
            'othername' => '',
            'email' => $request->email,
            'phone_number' => mt_rand(1, 99999),
            'password' => Hash::make($request->password),
            'is_admin' => true,
            'is_approved' => true,
            'state_id' => 1,
            'lga_id' => 1,
            'admin_role' => $request->admin_role,
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
    $data = [
        'surname' => $request->surname,
        'firstname' => $request->firstname,
        'email' => $request->email,
        'admin_role' => $request->admin_role,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $admin->update($data);

    return redirect()->route('admin.admins.index')
        ->with('success', 'Admin updated successfully');
}

public function destroy(User $admin)
{
    if ($admin->email === 'anonymous@coop8692.com') {
        return back()->with('error', 'Cannot delete system admin');
    }

    $admin->delete();
    return redirect()->route('admin.admins.index')
        ->with('success', 'Admin deleted successfully');
}

}
