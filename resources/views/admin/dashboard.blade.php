@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard</h1>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Members Stats -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Total Members</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ $data['total_members'] }}</p>
                </div>
            </div>
        </div>

        <!-- Loans Stats -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Active Loans</h2>
                    <p class="text-2xl font-semibold text-gray-800">{{ $data['active_loans'] }}</p>
                </div>
            </div>
        </div>

        <!-- Savings Stats -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-gray-600">Total Savings</h2>
                    <p class="text-2xl font-semibold text-gray-800">₦{{ number_format($data['total_savings']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Records Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Members -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Members</h2>
            <div class="space-y-4">
                @foreach($data['recent_members'] as $member)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $member->full_name }}</p>
                            <p class="text-sm text-gray-600">{{ $member->member_no }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs {{ $member->is_approved ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $member->is_approved ? 'Approved' : 'Pending' }}
                        </span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.members.index') }}" class="block mt-4 text-green-600 hover:text-green-700 text-sm">View all members →</a>
        </div>

        <!-- Recent Loans -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Loan Applications</h2>
            <div class="space-y-4">
                @foreach($data['recent_loans'] as $loan)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $loan->user->full_name }}</p>
                            <p class="text-sm text-gray-600">₦{{ number_format($loan->amount) }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs
                            @if($loan->status === 'approved') bg-green-100 text-green-800
                            @elseif($loan->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($loan->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.loans.index') }}" class="block mt-4 text-green-600 hover:text-green-700 text-sm">View all loans →</a>
        </div>

        <!-- Recent Savings -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Recent Savings</h2>
            <div class="space-y-4">
                @foreach($data['recent_savings'] as $saving)
                    <div class="flex items-center justify-between border-b pb-2">
                        <div>
                            <p class="font-medium">{{ $saving->user->full_name }}</p>
                            <p class="text-sm text-gray-600">₦{{ number_format($saving->amount) }}</p>
                        </div>
                        <span class="text-sm text-gray-500">
                            {{ $saving->created_at->diffForHumans() }}
                        </span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.savings.index') }}" class="block mt-4 text-green-600 hover:text-green-700 text-sm">View all savings →</a>
        </div>
    </div>
</div>
@endsection
