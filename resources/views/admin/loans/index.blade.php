@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Loan Management</h1>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="p-4 border-b">
            <div class="flex space-x-4">
                <a href="{{ route('admin.loans.index', ['status' => 'pending']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100' }}">
                    Pending
                </a>
                <a href="{{ route('admin.loans.index', ['status' => 'approved']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'approved' ? 'bg-green-100 text-green-800' : 'bg-gray-100' }}">
                    Approved
                </a>
                <a href="{{ route('admin.loans.index', ['status' => 'rejected']) }}"
                    class="px-4 py-2 rounded-lg {{ request('status') == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100' }}">
                    Rejected
                </a>
            </div>
        </div>

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Loan Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($loans as $loan)
                <tr>
                    <td class="px-6 py-4">{{ $loan->reference }}</td>
                    <td class="px-6 py-4">{{ $loan->user->full_name }}</td>
                    <td class="px-6 py-4">{{ $loan->loanType->name }}</td>
                    <td class="px-6 py-4">₦{{ number_format($loan->amount) }}</td>
                    <td class="px-6 py-4">{{ $loan->duration }} months</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                            @if($loan->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($loan->status === 'approved') bg-green-100 text-green-800
                            @elseif($loan->status === 'rejected') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.loans.show', $loan) }}"
                            class="text-indigo-600 hover:text-indigo-900">View Details</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-6 py-4">
            {{ $loans->links() }}
        </div>
    </div>
</div>
@endsection
