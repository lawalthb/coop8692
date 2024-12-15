@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Savings Report</h2>
                <button onclick="window.print()" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-green-50">
                    Print Report
                </button>
            </div>

            <!-- Filters -->
            <div class="p-6 border-b">
                <form action="{{ route('member.reports.savings') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                        <label class="block text-sm font-medium text-gray-700 mb-2">Savings Type</label>
                        <select name="saving_type_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">All Types</option>
                            @foreach($data['saving_types'] as $type)
                                <option value="{{ $type->id }}" {{ request('saving_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($data['savings'] as $saving)
                            <tr>
                                <td class="px-6 py-4">{{ $saving->transaction_date->format('d M, Y') }}</td>
                                <td class="px-6 py-4">{{ $saving->savingType->name }}</td>
                                <td class="px-6 py-4">{{ $saving->description }}</td>
                                <td class="px-6 py-4">
                                    @if($saving->credit_amount > 0)
                                        <span class="text-green-600">+₦{{ number_format($saving->credit_amount) }}</span>
                                    @else
                                        <span class="text-red-600">-₦{{ number_format($saving->debit_amount) }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">₦{{ number_format($saving->balance) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                    No savings records found for the selected period
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
                        <p class="text-sm text-gray-600">Total Deposits</p>
                        <p class="text-xl font-bold text-green-600">
                            ₦{{ number_format($data['savings']->sum('credit_amount')) }}
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="text-sm text-gray-600">Total Withdrawals</p>
                        <p class="text-xl font-bold text-red-600">
                            ₦{{ number_format($data['savings']->sum('debit_amount')) }}
                        </p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <p class="text-sm text-gray-600">Net Savings</p>
                        <p class="text-xl font-bold">
                            ₦{{ number_format($data['savings']->sum('credit_amount') - $data['savings']->sum('debit_amount')) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
