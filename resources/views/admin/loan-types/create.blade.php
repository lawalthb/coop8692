@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Create New Loan Type</h2>
            </div>

            <form action="{{ route('admin.loan-types.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Required Active Savings Months</label>
                        <input type="number" name="required_active_savings_months" value="{{ old('required_active_savings_months', 6) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Savings Multiplier</label>
                        <input type="number" name="savings_multiplier" value="{{ old('savings_multiplier', 2) }}" step="0.1" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Interest Rate (12 Months)</label>
                        <input type="number" name="interest_rate_12_months" value="{{ old('interest_rate_12_months', 10) }}" step="0.1" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Interest Rate (18 Months)</label>
                        <input type="number" name="interest_rate_18_months" value="{{ old('interest_rate_18_months', 15) }}" step="0.1" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Duration (Months)</label>
                        <input type="number" name="max_duration_months" value="{{ old('max_duration_months', 18) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Minimum Amount</label>
                        <input type="number" name="minimum_amount" value="{{ old('minimum_amount') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Amount</label>
                        <input type="number" name="maximum_amount" value="{{ old('maximum_amount') }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Number of Guarantors</label>
                        <input type="number" name="no_guarantors" value="{{ old('no_guarantors', 2) }}" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    
                </div>

                <div class="flex items-center mt-4">
                    <input type="checkbox" name="allow_early_payment" value="1" {{ old('allow_early_payment') ? 'checked' : '' }}
                        class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                    <label class="ml-2 text-sm text-gray-700">Allow Early Payment</label>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.loan-types.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Create Loan Type
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
