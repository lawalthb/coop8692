@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Edit Admin</h2>
            </div>

            <form action="{{ route('admin.admins.update', $admin) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surname</label>
                        <input type="text" name="surname" value="{{ old('surname', $admin->surname) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="firstname" value="{{ old('firstname', $admin->firstname) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Admin Role</label>
                        <select name="admin_role"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Role</option>
                            <option value="super_admin" {{ $admin->admin_role === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                            <option value="supervisor" {{ $admin->admin_role === 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            <option value="admin" {{ $admin->admin_role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="loan_manager" {{ $admin->admin_role === 'loan_manager' ? 'selected' : '' }}>Loan Manager</option>
                            <option value="savings_manager" {{ $admin->admin_role === 'savings_manager' ? 'selected' : '' }}>Savings Manager</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password (leave blank to keep current)</label>
                        <input type="password" name="password"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.admins.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Update Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
