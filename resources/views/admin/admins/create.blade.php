@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Create New Admin</h2>
            </div>

            <form action="{{ route('admin.admins.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surname</label>
                        <input type="text" name="surname" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="firstname" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                   <div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Role</label>
    <select name="admin_role"
        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
        <option value="">Select Role</option>
        <option value="super_admin">Super Admin</option>
        <option value="supervisor">Supervisor</option>
        <option value="admin">Admin</option>
        <option value="loan_manager">Loan Manager</option>
        <option value="savings_manager">Savings Manager</option>
    </select>
</div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input type="password" name="password_confirmation" required
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
                        Create Admin
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
