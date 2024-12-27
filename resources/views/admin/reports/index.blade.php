@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Summary Cards -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Members</h3>
            <div class="space-y-2">
                <p>Total Members: {{ $stats['total_members'] }}</p>
                <p>Active Members: {{ $stats['active_members'] }}</p>
                <a href="{{ route('admin.reports.members') }}" class="text-green-600 hover:text-green-700">View Details →</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Savings</h3>
            <div class="space-y-2">
                <p>Total Savings: ₦{{ number_format($stats['total_savings'], 2) }}</p>
                <a href="{{ route('admin.reports.savings') }}" class="text-green-600 hover:text-green-700">View Details →</a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Loans</h3>
            <div class="space-y-2">
                <p>Active Loans: {{ $stats['active_loans'] }}</p>
                <p>Total Amount: ₦{{ number_format($stats['loan_amount'], 2) }}</p>
                <a href="{{ route('admin.reports.loans') }}" class="text-green-600 hover:text-green-700">View Details →</a>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="mt-8 bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Detailed Reports</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.reports.members') }}" class="p-4 border rounded-lg hover:bg-green-50">
                Members Report
            </a>
            <a href="{{ route('admin.reports.savings') }}" class="p-4 border rounded-lg hover:bg-green-50">
                Savings Report
            </a>
            <a href="{{ route('admin.reports.loans') }}" class="p-4 border rounded-lg hover:bg-green-50">
                Loans Report
            </a>
            <a href="{{ route('admin.reports.transactions') }}" class="p-4 border rounded-lg hover:bg-green-50">
                Transactions Report
            </a>
        </div>
    </div>
</div>
@endsection
