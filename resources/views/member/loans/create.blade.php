@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Apply for Loan</h2>
            </div>

            <form action="{{ route('member.loans.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Loan Type</label>
                    <select name="loan_type_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @foreach($loanTypes as $type)
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration (Months)</label>
                    <select name="duration" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        @for($i = 6; $i <= 18; $i += 6)
                            <option value="{{ $i }}">{{ $i }} months</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Purpose of Loan</label>
                    <textarea name="purpose" required rows="3"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('member.loans.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const loanTypeSelect = document.querySelector('[name="loan_type_id"]');
    const amountInput = document.querySelector('[name="amount"]');
    const durationSelect = document.querySelector('[name="duration"]');

    function calculateLoan() {
        const loanType = @json($loanTypes);
        const selectedLoan = loanType.find(type => type.id == loanTypeSelect.value);

        if (selectedLoan) {
            const amount = parseFloat(amountInput.value);
            const duration = parseInt(durationSelect.value);

            // Validate amount limits
            if (amount < selectedLoan.minimum_amount) {
                amountInput.value = selectedLoan.minimum_amount;
            } else if (amount > selectedLoan.maximum_amount) {
                amountInput.value = selectedLoan.maximum_amount;
            }

            // Calculate interest based on duration
            const interestRate = duration <= 12 ?
                selectedLoan.interest_rate_12_months :
                selectedLoan.interest_rate_18_months;

            // Update UI with calculations
            updateCalculations(amount, interestRate, duration);
        }
    }

    [loanTypeSelect, amountInput, durationSelect].forEach(element => {
        element.addEventListener('change', calculateLoan);
    });
});
</script>
@endpush
