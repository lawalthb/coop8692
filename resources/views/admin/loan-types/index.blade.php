@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Loan Types</h1>
        <a href="{{ route('admin.loan-types.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Add New Loan Type
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Interest Rate (12m)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Interest Rate (18m)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Min Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Max Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($loanTypes as $type)
                <tr>
                    <td class="px-6 py-4">{{ $type->name }}</td>
                    <td class="px-6 py-4">{{ $type->interest_rate_12_months }}%</td>
                    <td class="px-6 py-4">{{ $type->interest_rate_18_months }}%</td>
                    <td class="px-6 py-4">₦{{ number_format($type->minimum_amount) }}</td>
                    <td class="px-6 py-4">₦{{ number_format($type->maximum_amount) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $type->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $type->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.loan-types.edit', $type) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
