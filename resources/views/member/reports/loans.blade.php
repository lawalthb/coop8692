@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Loan Report</h2>
                <button onclick="window.print()" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-green-50">
                    Print Report
                </button>
            </div>

            <!-- Filters -->
            <div class="p-6 border-b">
                <form action="{{ route('member.reports.loans') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                        <select name="month_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Months</option>
                            @foreach($data['months'] as $month)
                                <option value="{{ $month->id }}" {{ request('month_id') == $month->id ? 'selected' : '' }}>
                                    {{ $month->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <select name="year_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Years</option>
                            @foreach($data['years'] as $year)
                                <option value="{{ $year->id }}" {{ request('year_id') == $year->id ? 'selected' : '' }}>
                                    {{ $year->year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Loan Type</label>
                        <select name="loan_type_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Types</option>
                            @foreach($data['loan_types'] as $type)
                                <option value="{{ $type->id }}" {{ request('loan_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <div class="md:col-span-4">
                        <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Generate Report
                        </button>
                    </div>
                </form>
            </div>

            <!-- Report Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Duration</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paid Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Start Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($data['loans'] as $loan)
                            <tr>
                                <td class="px-6 py-4">{{ $loan->reference }}</td>
                                <td class="px-6 py-4">{{ $loan->loanType->name }}</td>
                                <td class="px-6 py-4">₦{{ number_format($loan->amount) }}</td>
                                <td class="px-6 py-4">{{ $loan->duration }} months</td>
                                <td class="px-6 py-4">₦{{ number_format($loan->paid_amount) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($loan->status === 'active') bg-green-100 text-green-800
                                        @elseif($loan->status === 'completed') bg-blue-100 text-blue-800
                                        @elseif($loan->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($loan->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">{{ $loan->start_date ? $loan->start_date->format('d M, Y') : '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No loan records found for the selected period
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Summary Section -->
            <div class="p-6 bg-gray-50 border-t">
                <h3 class="text-lg font-semibold mb-4">Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="text-sm text-gray-600">Total Loans</p>
                        <p class="text-xl font-bold">{{ $data['loans']->count() }}</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="text-sm text-gray-600">Total Amount</p>
                        <p class="text-xl font-bold text-green-600">
                            ₦{{ number_format($data['loans']->sum('amount')) }}
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="text-sm text-gray-600">Total Paid</p>
                        <p class="text-xl font-bold text-blue-600">
                            ₦{{ number_format($data['loans']->sum('paid_amount')) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
