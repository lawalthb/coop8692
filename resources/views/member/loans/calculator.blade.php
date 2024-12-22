@extends('layouts.member')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Loan Calculator</h2>
        </div>

        <div class="p-6">
            <form id="calculatorForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Loan Type</label>
                    <select name="loanType" id="loanType" required>
                        <option value="">Select Loan Type</option>
                        @foreach($loanTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                    <input type="number" name="amount" id="amount" min="0" step="100" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Duration (Months)</label>
                    <select name="duration" id="duration" required>

                        <option value="4">4 Months</option>

                    </select>
                </div>

                <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    Calculate
                </button>
            </form>

            <!-- Results Section -->
            <div id="results" class="mt-6 border rounded-lg hidden">
                <div id="messageBox" class="p-4">
                    <p id="message" class="text-lg font-medium"></p>
                </div>

                <div id="loanDetails" class="p-4 bg-white hidden">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center border-b py-2">
                            <span class="text-gray-600">Monthly Payment</span>
                            <span id="monthlyPayment" class="text-lg font-semibold"></span>
                        </div>
                        <div class="flex justify-between items-center border-b py-2">
                            <span class="text-gray-600">Total Interest</span>
                            <span id="totalInterest" class="text-lg font-semibold"></span>
                        </div>
                        <div class="flex justify-between items-center border-b py-2">
                            <span class="text-gray-600">Total Repayment</span>
                            <span id="totalRepayment" class="text-lg font-semibold"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('calculatorForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = {
            loan_type_id: document.getElementById('loanType').value,
            amount: document.getElementById('amount').value,
            duration: document.getElementById('duration').value
        };

        console.log('Form Data:', formData);

        try {
            const response = await fetch('/member/loan-calculator', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();
            console.log('Raw response:', data);
            displayResults(data);
        } catch (error) {
            console.error('Error:', error);
        }
    });

    function displayResults(data) {
        const results = document.getElementById('results');
        const messageBox = document.getElementById('messageBox');
        const message = document.getElementById('message');
        const loanDetails = document.getElementById('loanDetails');

        results.classList.remove('hidden');
        messageBox.className = data.eligible ? 'p-4 bg-green-50' : 'p-4 bg-red-50';
        message.className = data.eligible ? 'text-lg font-medium text-green-700' : 'text-lg font-medium text-red-700';
        message.textContent = data.eligible ? 'You are eligible for this loan.' : 'You are not eligible for this loan.';

        if (data.eligible) {
            loanDetails.classList.remove('hidden');
            document.getElementById('monthlyPayment').textContent = '₦' + data.monthly_payment.toFixed(2);
            document.getElementById('totalInterest').textContent = '₦' + data.interest_amount.toFixed(2);
            document.getElementById('totalRepayment').textContent = '₦' + data.total_amount.toFixed(2);
        } else {
            loanDetails.classList.add('hidden');
        }
    }
</script>
@endpush

@endsection
