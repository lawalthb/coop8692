@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Record Grant Entry</h2>
            </div>

            <form action="{{ route('admin.grants.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Date</label>
                    <input type="date" name="transaction_date" required
                        value="{{ now()->format('Y-m-d') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">

                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" required step="0.01" min="0"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Purpose/Description (Optional)</label>
                    <textarea name="description"  rows="2"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                </div>


                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reference Number (Optional)</label>
                    <input type="text" name="reference"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.transactions.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Record Grant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
