@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Record Loan Repayment</h2>
            </div>

            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Loan Information</h3>
                    <dl class="grid grid-cols-2 gap-4">
                        <div>
                            <dt class="text-gray-600">Member:</dt>
                            <dd class="font-medium">{{ $loan->user->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600">Reference:</dt>
                            <dd class="font-medium">{{ $loan->reference }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600">Total Amount:</dt>
                            <dd class="font-medium">₦{{ number_format($loan->total_amount) }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600">Amount Paid:</dt>
                            <dd class="font-medium">₦{{ number_format($loan->paid_amount) }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-600">Balance:</dt>
                            <dd class="font-medium">₦{{ number_format($loan->total_amount - $loan->paid_amount) }}</dd>
                        </div>
                    </dl>
                </div>

                <form action="{{ route('admin.loans.repayments.store', $loan) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" name="amount" required step="0.01" min="0" max="{{ $loan->total_amount - $loan->paid_amount }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Date</label>
                        <input type="date" name="payment_date" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                        <select name="payment_method" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Notes</label>
                        <textarea name="notes" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.loans.show', $loan) }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Record Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
