@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Savings</h1>
    </div>

    <!-- Savings Summary -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Savings</h3>
                <p class="text-3xl font-bold text-green-600">₦{{ number_format($data['total_savings']) }}</p>
            </div>
            @foreach($data['saving_types'] as $type)
            <div>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">{{ $type->name }}</h3>
                <p class="text-sm text-gray-600 mb-1">Interest Rate: {{ $type->interest_rate }}%</p>
                <p class="text-sm text-gray-600">Minimum Balance: ₦{{ number_format($type->minimum_balance) }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Savings Transactions -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Transaction History</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <!-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th> -->
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data['transactions'] as $transaction)
                    <tr>
                        <td class="px-6 py-4">{{ $transaction->transaction_date->format('d M, Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->reference }}</td>
                        <!-- <td class="px-6 py-4">{{ $transaction->description }}</td> -->
                        <td class="px-6 py-4">
                            @if($transaction->credit_amount > 0)
                                <span class="text-green-600">+₦{{ number_format($transaction->credit_amount) }}</span>
                            @else
                                <span class="text-red-600">-₦{{ number_format($transaction->debit_amount) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">₦{{ number_format($transaction->balance) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            No transactions found
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t">
            {{ $data['transactions']->links() }}
        </div>
    </div>
</div>
@endsection
