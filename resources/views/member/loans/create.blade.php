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
                    <select name="loan_type_id" id="loan_type_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500" onchange="showGuarantorFields()">
                        <option value="">Select Loan Type</option>
                        @foreach($loanTypes as $type)
                        <option value="{{ $type->id }}" data-guarantors="{{ $type->no_guarantors }}">{{ $type->name }}</option>
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

                        <option value="4">4 months</option>

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Purpose of Loan</label>
                    <textarea name="purpose" required rows="3"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                </div>


                <div id="guarantor_fields" class="space-y-4"></div>


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

<script>
    function showGuarantorFields() {
       
        const loanTypeSelect = document.getElementById('loan_type_id');
        const selectedOption = loanTypeSelect.options[loanTypeSelect.selectedIndex];
        const guarantorCount = selectedOption.dataset.guarantors;
        const guarantorContainer = document.getElementById('guarantor_fields');

        guarantorContainer.innerHTML = '';

        for (let i = 0; i < guarantorCount; i++) {
            const guarantorField = `
            <div class="border p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Guarantor ${i + 1}</label>
                <select name="guarantors[]" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    <option value="">Select Guarantor</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}">{{ $member->full_name }}</option>
                    @endforeach
                </select>
            </div>
        `;
            guarantorContainer.insertAdjacentHTML('beforeend', guarantorField);
        }
    }
</script>

@endsection
