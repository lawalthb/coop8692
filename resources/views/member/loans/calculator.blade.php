@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Loan Calculator</h2>
            </div>

            <div class="p-6">
                <form id="calculatorForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Loan Type</label>
                        <select name="loan_type_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="">Select Loan Type</option>
                            @foreach($loanTypes as $type)
                                <option value="{{ $type->id }}"
                                    data-min="{{ $type->minimum_amount }}"
                                    data-max="{{ $type->maximum_amount }}"
                                    data-multiplier="{{ $type->savings_multiplier }}">
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" name="amount" required min="0" step="0.01"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        <p class="mt-1 text-sm text-gray-500" id="amountLimits"></p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration (Months)</label>
                        <select name="duration" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <option value="6">6 months</option>
                            <option value="12">12 months</option>
                            <option value="18">18 months</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                        Calculate
                    </button>
                </form>

                <!-- Results Section (Hidden by default) -->
                <div id="results" class="mt-8 hidden">
                    <h3 class="text-lg font-semibold mb-4">Loan Details</h3>
                    <div class="space-y-4">
                        <div class="p-4 rounded-lg" id="eligibilityStatus"></div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Interest Amount</p>
                                <p class="text-lg font-semibold" id="interestAmount"></p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <p class="text-sm text-gray-600">Total Repayment</p>
                                <p class="text-lg font-semibold" id="totalAmount"></p>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg col-span-2">
                                <p class="text-sm text-gray-600">Monthly Payment</p>
                                <p class="text-lg font-semibold" id="monthlyPayment"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('calculatorForm');
    const loanTypeSelect = form.querySelector('[name="loan_type_id"]');
    const amountInput = form.querySelector('[name="amount"]');
    const amountLimits = document.getElementById('amountLimits');

    loanTypeSelect.addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        if (selected.value) {
            const min = selected.dataset.min;
            const max = selected.dataset.max;
            amountLimits.textContent = `Amount should be between ₦${Number(min).toLocaleString()} and ₦${Number(max).toLocaleString()}`;
            amountInput.min = min;
            amountInput.max = max;
        }
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        fetch('{{ route("member.loans.calculate") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                loan_type_id: loanTypeSelect.value,
                amount: amountInput.value,
                duration: form.querySelector('[name="duration"]').value
            })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('results').classList.remove('hidden');

            const eligibilityDiv = document.getElementById('eligibilityStatus');
            if (data.eligible) {
                eligibilityDiv.className = 'p-4 rounded-lg bg-green-100 text-green-800';
                eligibilityDiv.textContent = 'You are eligible for this loan';
            } else {
                eligibilityDiv.className = 'p-4 rounded-lg bg-red-100 text-red-800';
                eligibilityDiv.textContent = 'You are not eligible for this loan amount';
            }

            document.getElementById('interestAmount').textContent = `₦${Number(data.interest_amount).toLocaleString()}`;
            document.getElementById('totalAmount').textContent = `₦${Number(data.total_amount).toLocaleString()}`;
            document.getElementById('monthlyPayment').textContent = `₦${Number(data.monthly_payment).toLocaleString()}`;
        });
    });
});
</script>
@endpush
@endsection
