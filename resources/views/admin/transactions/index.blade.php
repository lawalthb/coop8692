@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">All Transactions</h2>
        </div>

        <div class="p-6">
            <!-- Summary Cards -->
            <div class="grid grid-cols-3 gap-6 mb-6">
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

            <!-- Enhanced Filter Form -->
            <div class="mb-6">
                <form action="{{ route('admin.transactions.index') }}" method="GET">
                    <div class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start_date"
                                class="w-full rounded-lg border-gray-300"
                                value="{{ request('start_date') }}">
                        </div>

                        <div class="flex-1">
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end_date"
                                class="w-full rounded-lg border-gray-300"
                                value="{{ request('end_date') }}">
                        </div>

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

                        <div>
                            <button type="submit" class="w-full md:w-auto px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Credit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Debit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @php $runningBalance = 0; @endphp
                    @foreach($transactions as $transaction)
                    @php
                    $runningBalance += ($transaction->credit_amount - $transaction->debit_amount);
                    @endphp
                    <tr>
                        <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->user->full_name }}</td>
                        <td class="px-6 py-4">{{ $transaction->reference }}</td>
                        <td class="px-6 py-4" title="{{ $transaction->description }}">{{ ucfirst($transaction->type) }}</td>
                        <td class="px-6 py-4 text-green-600">{{ $transaction->credit_amount ? '₦'.number_format($transaction->credit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-red-600">{{ $transaction->debit_amount ? '₦'.number_format($transaction->debit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4 font-medium">₦{{ number_format($runningBalance, 2) }}</td>

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
