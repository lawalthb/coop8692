@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">My Loans</h1>
        <div class="space-x-4">
            <a href="{{ route('member.loan.calculator') }}" class="bg-blue-600 text-white px-2 py-1 rounded-lg hover:bg-blue-700">
                Loan Calculator
            </a>
            <a href="{{ route('member.loans.create') }}" class="bg-green-600 text-white px-2 py-1 rounded-lg hover:bg-green-700">
                Apply for Loan
            </a>
        </div>
    </div>



    @push('scripts')
    <script>
        function calculateLoan() {
            fetch(`/api/loan-calculator`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        loan_type_id: this.loanType,
                        amount: this.amount,
                        duration: this.duration
                    })
                })
                .then(response => response.json())
                .then(data => {
                    this.result = data;
                });
        }
    </script>
    @endpush

    <!-- Active & Pending Loans -->
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Active & Pending Loans</h3>
        </div>
        <div class="p-6">
            @if($data['active_loans']->count() > 0)
            <div class="space-y-4">
                @foreach($data['active_loans'] as $loan)
                <div class="border rounded-lg p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="font-medium">{{ $loan->reference }}</p>
                            <p class="text-sm text-gray-600">Amount: ₦{{ number_format($loan->amount) }}</p>
                            <p class="text-sm text-gray-600">Duration: {{ $loan->duration }} months</p>
                        </div>
                        <a href="{{ route('member.loans.show', $loan->id) }}" >
                            <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    @if($loan->status === 'approved') bg-green-100 text-green-800
                                    @elseif($loan->status === 'pending') bg-yellow-100 text-yellow-800
                                    @endif">
                                {{ ucfirst($loan->status) }}
                            </span>
                        </a>
                    </div> @if($loan->status === 'approved')
                    <div class="mt-4">
                        <div class="bg-gray-100 rounded-lg p-3">
                            <div class="flex justify-between text-sm">
                                <span>Progress</span>
                                <span>{{ number_format(($loan->paid_amount / $loan->total_amount) * 100, 1) }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 mt-2">
                                <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ ($loan->paid_amount / $loan->total_amount) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center">No active or pending loans</p>
            @endif
        </div>
    </div>



    <!-- Add this section after the active loans section -->
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Loan Repayment History</h3>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Loan Reference</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Payment Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($data['active_loans'] as $loan)
                        @foreach($loan->repayments as $repayment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $loan->reference }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $repayment->payment_date->format('d M, Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">₦{{ number_format($repayment->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ ucfirst($repayment->payment_method) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $repayment->reference_number }}</td>
                        </tr>
                        @endforeach
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                No repayment records found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @endsection
