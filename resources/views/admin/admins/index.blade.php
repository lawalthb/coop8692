@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Admin Management</h1>
        <a href="{{ route('admin.admins.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Add New Admin
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Admin ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($admins as $admin)
                <tr>
                    <td class="px-6 py-4">{{ $admin->member_no }}</td>
                    <td class="px-6 py-4">{{ $admin->surname }} {{ $admin->firstname }}</td>
                    <td class="px-6 py-4">{{ $admin->email }}</td>
                    <td class="px-6 py-4">{{ $admin->admin_role }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('admin.admins.edit', $admin) }}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>

                            @if($admin->email !== 'anonymous@coop8692.com')
                                <form action="{{ route('admin.admins.destroy', $admin) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this admin?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $admins->links() }}
        </div>
    </div>
</div>
@endsection
