@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Savings</h3>
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-900">₦{{ number_format($data['total_savings']) }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Share Capital</h3>
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-900">₦{{ number_format($data['total_shares']) }}</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Active Loans</h3>
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <p class="text-2xl font-bold text-gray-900">{{ $data['active_loans']->count() }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Active Loans -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-700">Active Loans</h3>
            </div>
            <div class="p-6">
                @forelse($data['active_loans'] as $loan)
                    <div class="mb-4 last:mb-0">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-medium">{{ $loan->reference }}</p>
                                <p class="text-sm text-gray-600">Amount: ₦{{ number_format($loan->amount) }}</p>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                {{ number_format(($loan->paid_amount / $loan->total_amount) * 100, 1) }}% Paid
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full" style="width: {{ ($loan->paid_amount / $loan->total_amount) * 100 }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center">No active loans</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white rounded-lg shadow-lg">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-700">Recent Transactions</h3>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($data['recent_transactions'] as $transaction)
                    <div class="p-4">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="font-medium">{{ $transaction->description }}</p>
                                <p class="text-sm text-gray-500">{{ $transaction->transaction_date->format('d M, Y') }}</p>
                            </div>
                            <span class="{{ $transaction->credit_amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->credit_amount > 0 ? '+' : '-' }}₦{{ number_format($transaction->credit_amount ?: $transaction->debit_amount) }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-gray-500">
                        No recent transactions
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
