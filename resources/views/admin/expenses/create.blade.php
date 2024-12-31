@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Record New Expense</h2>
            </div>

            <form action="{{ route('admin.expenses.store') }}" method="POST" class="p-6">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Date</label>
                    <input type="date" name="transaction_date" required
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                        value="{{ now()->format('Y-m-d') }}">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" required step="0.01" min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea name="description" required
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500"
                        rows="3"></textarea>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reference (Optional)</label>
                    <input type="text" name="reference"
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500">
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Record Expense
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
