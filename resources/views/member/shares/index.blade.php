@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Share Capital Summary -->
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Share Capital</h2>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Share Capital</h3>
                    <p class="text-3xl font-bold text-green-600">₦{{ number_format($data['total_shares']) }}</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Share Value</h3>
                    <p class="text-xl">₦{{ number_format(config('cooperative.share_value', 1000)) }} per share</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Number of Shares</h3>
                    <p class="text-xl">{{ number_format($data['total_shares'] / config('cooperative.share_value', 1000)) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Transactions -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Share Capital History</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data['transactions'] as $transaction)
                    <tr>
                        <td class="px-6 py-4">{{ $transaction->transaction_date->format('d M, Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->reference }}</td>
                        <td class="px-6 py-4">{{ $transaction->description }}</td>
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
                            No share transactions found
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
