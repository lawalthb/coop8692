@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Account Statement</h2>
                <form action="{{ route('member.statements.download') }}" method="GET" class="flex items-center">
                    <input type="hidden" name="type" value="{{ request('type') }}">
                    <input type="hidden" name="date_from" value="{{ request('date_from') }}">
                    <input type="hidden" name="date_to" value="{{ request('date_to') }}">
                    <button type="submit" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-green-50">
                        Download PDF
                    </button>
                </form>
            </div>

            <!-- Filters -->
            <div class="p-6 border-b">
                <form action="{{ route('member.statements.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Type</label>
                        <select name="type" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Types</option>
                            <option value="savings" {{ request('type') === 'savings' ? 'selected' : '' }}>Savings</option>
                            <option value="shares" {{ request('type') === 'shares' ? 'selected' : '' }}>Shares</option>
                            <option value="loan" {{ request('type') === 'loan' ? 'selected' : '' }}>Loan</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">From Date</label>
                        <input type="date" name="date_from" value="{{ request('date_from') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">To Date</label>
                        <input type="date" name="date_to" value="{{ request('date_to') }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Transactions Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Debit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Credit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4">{{ $transaction->transaction_date->format('d M, Y') }}</td>
                                <td class="px-6 py-4">{{ $transaction->reference }}</td>
                                <td class="px-6 py-4">{{ ucfirst($transaction->type) }}</td>
                                <td class="px-6 py-4">{{ $transaction->description }}</td>
                                <td class="px-6 py-4 text-red-600">
                                    {{ $transaction->debit_amount > 0 ? '₦'.number_format($transaction->debit_amount) : '-' }}
                                </td>
                                <td class="px-6 py-4 text-green-600">
                                    {{ $transaction->credit_amount > 0 ? '₦'.number_format($transaction->credit_amount) : '-' }}
                                </td>
                                <td class="px-6 py-4">₦{{ number_format($transaction->balance) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No transactions found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
                <div class="px-6 py-4 border-t">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
