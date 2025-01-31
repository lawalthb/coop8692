@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Member Management</h1>
        <a href="{{ route('admin.members.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Add New Member
        </a>
    </div>
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b bg-white">
            <div class="flex space-x-4">
                <a href="{{ route('admin.members.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded-lg font-medium transition-colors duration-150
            {{ request('status') == 'pending'
                ? 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Pending Approval
                </a>

                <a href="{{ route('admin.members.index', ['status' => 'approved']) }}"
                    class="px-4 py-2 rounded-lg font-medium transition-colors duration-150
            {{ request('status') == 'approved'
                ? 'bg-green-100 text-green-800 hover:bg-green-200'
                : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                    Approved
                </a>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">S/N</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Phone</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($members as $index => $member)
                <tr>
                    <td class="px-6 py-4">{{ $members->firstItem() + $index }}</td>
                    <td class="px-6 py-4">{{ $member->member_no }}</td>
                    <td class="px-6 py-4">{{ $member->full_name }}</td>
                    <td class="px-6 py-4">{{ $member->email }}</td>
                    <td class="px-6 py-4">{{ $member->phone_number }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            {{ $member->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $member->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.members.show', $member) }}"
                            class="text-indigo-600 hover:text-indigo-900">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $members->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
