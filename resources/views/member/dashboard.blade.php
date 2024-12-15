@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Welcome, {{ auth()->user()->firstname }}!</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Savings Summary -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Total Savings</h3>
                <span class="text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold">₦{{ number_format($data['total_savings']) }}</p>
        </div>

        <!-- Shares Summary -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Share Capital</h3>
                <span class="text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold">₦{{ number_format($data['total_shares']) }}</p>
        </div>

        <!-- Active Loans -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-700">Active Loans</h3>
                <span class="text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </span>
            </div>
            <p class="text-2xl font-bold">{{ $data['active_loans']->count() }}</p>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Recent Transactions</h3>
        </div>
        <div class="p-6">
            @if($data['recent_transactions']->count() > 0)
                <div class="space-y-4">
                    @foreach($data['recent_transactions'] as $transaction)
                        <div class="flex items-center justify-between p-4 border rounded-lg">
                            <div>
                                <p class="font-medium">{{ $transaction->description }}</p>
                                <p class="text-sm text-gray-600">{{ $transaction->transaction_date->format('d M, Y') }}</p>
                            </div>
                            <div class="text-right">
                                @if($transaction->credit_amount > 0)
                                    <p class="text-green-600 font-medium">+₦{{ number_format($transaction->credit_amount) }}</p>
                                @else
                                    <p class="text-red-600 font-medium">-₦{{ number_format($transaction->debit_amount) }}</p>
                                @endif
                                <p class="text-sm text-gray-600">{{ $transaction->reference }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center">No recent transactions</p>
            @endif
        </div>
    </div>
</div>
@endsection
