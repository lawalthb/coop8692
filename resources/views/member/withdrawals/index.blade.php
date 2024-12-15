@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Withdrawal Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Request Withdrawal</h2>
            </div>

            <form action="{{ route('member.withdrawals.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Savings Type</label>
                        <select name="saving_type_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            @foreach($savingTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" name="amount" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Bank Name</label>
                        <input type="text" name="bank_name" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Account Number</label>
                        <input type="text" name="account_number" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Account Name</label>
                        <input type="text" name="account_name" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Withdrawal</label>
                        <textarea name="reason" required rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Submit Request
                    </button>
                </div>
            </form>
        </div>

        <!-- Withdrawal History -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-700">Withdrawal History</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($withdrawals as $withdrawal)
                        <tr>
                            <td class="px-6 py-4">{{ $withdrawal->created_at->format('d M, Y') }}</td>
                            <td class="px-6 py-4">{{ $withdrawal->reference }}</td>
                            <td class="px-6 py-4">₦{{ number_format($withdrawal->amount) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($withdrawal->status === 'approved') bg-green-100 text-green-800
                                    @elseif($withdrawal->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($withdrawal->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                No withdrawal requests found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t">
                {{ $withdrawals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
