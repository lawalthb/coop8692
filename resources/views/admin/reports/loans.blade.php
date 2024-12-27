@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Loans Report</h2>
        </div>

        <div class="p-6">

            <!-- Export Buttons -->
            <div class="flex justify-end space-x-4 mb-6">
                <a href="{{ route('admin.reports.loans.export', ['format' => 'pdf'] + request()->all()) }}"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Export PDF
                </a>

                <a href="{{ route('admin.reports.loans.export', ['format' => 'excel'] + request()->all()) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Excel
                </a>
            </div>
            <!-- Filter Form -->
            <div class="mb-6">
                <form action="{{ route('admin.reports.loans') }}" method="GET" class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Member</label>
                        <select name="member_id" class="w-full rounded-lg border-gray-300">
                            <option value="">All Members</option>
                            @foreach($members as $member)
                            <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                                {{ $member->full_name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full rounded-lg border-gray-300">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" name="date_from" class="w-full rounded-lg border-gray-300" value="{{ request('date_from') }}">
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" name="date_to" class="w-full rounded-lg border-gray-300" value="{{ request('date_to') }}">
                    </div>

                    <div>
                        <button type="submit" class="w-full md:w-auto px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-green-700">Total Loans</h3>
                    <p class="text-2xl font-bold text-green-600">{{ $loans->count() }}</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-blue-700">Total Amount</h3>
                    <p class="text-2xl font-bold text-blue-600">₦{{ number_format($loans->sum('amount'), 2) }}</p>
                </div>
                <div class="bg-yellow-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-yellow-700">Total Interest</h3>
                    <p class="text-2xl font-bold text-yellow-600">₦{{ number_format($loans->sum('interest_amount'), 2) }}</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-purple-700">Average Loan Amount</h3>
                    <p class="text-2xl font-bold text-purple-600">₦{{ number_format($loans->avg('amount'), 2) }}</p>
                </div>
            </div>



            <!-- Loans Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Interest</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($loans as $loan)
                    <tr>
                        <td class="px-6 py-4">{{ $loan->reference }}</td>
                        <td class="px-6 py-4">{{ $loan->user->full_name }}</td>
                        <td class="px-6 py-4">₦{{ number_format($loan->amount, 2) }}</td>
                        <td class="px-6 py-4">₦{{ number_format($loan->interest_amount, 2) }}</td>
                        <td class="px-6 py-4">{{ $loan->duration }} months</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium rounded-full
                                {{ $loan->status === 'approved' ? 'bg-green-100 text-green-800' :
                                   ($loan->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                                   ($loan->status === 'rejected' ? 'bg-red-100 text-red-800' :
                                   'bg-blue-100 text-blue-800')) }}">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $loan->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $loans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
