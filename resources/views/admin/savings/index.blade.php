@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Savings Management</h1>
        <div class="space-x-4">
            <a href="{{ route('admin.savings.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                Single Entry
            </a>
            <a href="{{ route('admin.savings.bulk-create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Bulk Entry
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Saving Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($transactions as $transaction)
                <tr>
                    <td class="px-6 py-4">{{ $transaction->created_at->format('d M, Y') }}</td>
                    <td class="px-6 py-4">{{ $transaction->user->full_name }}</td>
                    <td class="px-6 py-4">{{ $transaction->savingType?->name ?? 'N/A' }}</td>

                    <td class="px-6 py-4">₦{{ number_format($transaction->amount) }}</td>
                    <td class="px-6 py-4">{{ $transaction->reference }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                            {{ $transaction->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
