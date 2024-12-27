@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Transactions Report</h2>
        </div>

        <div class="p-6">
            <!-- Export Buttons -->
            <div class="flex justify-end space-x-4 mb-6">
                <a href="{{ route('admin.reports.transactions.export', ['format' => 'pdf'] + request()->all()) }}"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                    </svg>
                    Export PDF
                </a>

                <a href="{{ route('admin.reports.transactions.export', ['format' => 'excel'] + request()->all()) }}"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Export Excel
                </a>
            </div>
            <!-- Filter Form -->
            <div class="mb-6">
                <form action="{{ route('admin.reports.transactions') }}" method="GET" class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
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
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                        <select name="type" class="w-full rounded-lg border-gray-300">
                            <option value="">All Types</option>
                            @foreach($transactionTypes as $type)
                            <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                            @endforeach
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-green-700">Total Credits</h3>
                    <p class="text-2xl font-bold text-green-600">₦{{ number_format($transactions->sum('credit_amount'), 2) }}</p>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-red-700">Total Debits</h3>
                    <p class="text-2xl font-bold text-red-600">₦{{ number_format($transactions->sum('debit_amount'), 2) }}</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-blue-700">Net Balance</h3>
                    <p class="text-2xl font-bold text-blue-600">₦{{ number_format($transactions->sum('credit_amount') - $transactions->sum('debit_amount'), 2) }}</p>
                </div>
            </div>



            <!-- Transactions Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Credit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Debit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->reference }}</td>
                        <td class="px-6 py-4">{{ $transaction->user->full_name }}</td>
                        <td class="px-6 py-4">{{ ucfirst($transaction->type) }}</td>
                        <td class="px-6 py-4 text-green-600">{{ $transaction->credit_amount ? '₦'.number_format($transaction->credit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-red-600">{{ $transaction->debit_amount ? '₦'.number_format($transaction->debit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4">{{ $transaction->description }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
