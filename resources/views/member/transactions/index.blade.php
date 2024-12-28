@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">My Transactions</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-green-50 p-3 md:p-4 rounded-lg">
                    <h3 class="text-xs md:text-sm font-medium text-green-700">Total Credits</h3>
                    <p class="text-lg md:text-2xl font-bold text-green-600">₦{{ number_format($transactions->sum('credit_amount'), 2) }}</p>
                </div>

                <div class="bg-red-50 p-3 md:p-4 rounded-lg">
                    <h3 class="text-xs md:text-sm font-medium text-red-700">Total Debits</h3>
                    <p class="text-lg md:text-2xl font-bold text-red-600">₦{{ number_format($transactions->sum('debit_amount'), 2) }}</p>
                </div>

                <div class="bg-blue-50 p-3 md:p-4 rounded-lg">
                    <h3 class="text-xs md:text-sm font-medium text-blue-700">Current Balance</h3>
                    <p class="text-lg md:text-2xl font-bold text-blue-600">₦{{ number_format($transactions->sum('credit_amount') - $transactions->sum('debit_amount'), 2) }}</p>
                </div>
            </div>


            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Credit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Debit</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Balance</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Status/Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td class="px-6 py-4">{{ $transaction->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">{{ $transaction->reference }}</td>
                        <td class="px-6 py-4">{{ ucfirst($transaction->type) }}</td>
                        <td class="px-6 py-4 text-green-600">{{ $transaction->credit_amount ? '₦'.number_format($transaction->credit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4 text-red-600">{{ $transaction->debit_amount ? '₦'.number_format($transaction->debit_amount, 2) : '-' }}</td>
                        <td class="px-6 py-4 font-medium">₦{{ number_format($transaction->running_balance, 2) }}</td>
                        <td class="px-6 py-4">
                            @if($transaction->dispute)
                            @if($transaction->dispute->admin_response)
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">Admin Response:</span><br>
                                {{ $transaction->dispute->admin_response }}
                            </div>
                            @else
                            <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                Dispute Pending
                            </span>
                            @endif
                            @else
                            <button onclick="openDisputeModal({{ $transaction->id }})"
                                class="text-red-600 hover:text-red-900">
                                Raise Dispute
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dispute Modal -->
    <div id="disputeModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
        <div class="flex items-center justify-center min-h-screen">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                <h3 class="text-lg font-semibold mb-4">Raise Transaction Dispute</h3>
                <form action="{{ route('member.disputes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="transaction_id" id="disputeTransactionId">

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description of Issue</label>
                        <textarea name="description" required rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeDisputeModal()"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Submit Dispute
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openDisputeModal(transactionId) {
            document.getElementById('disputeTransactionId').value = transactionId;
            document.getElementById('disputeModal').classList.remove('hidden');
        }

        function closeDisputeModal() {
            document.getElementById('disputeModal').classList.add('hidden');
        }
    </script>
    @endpush
    @endsection
