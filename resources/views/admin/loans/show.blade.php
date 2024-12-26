@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Loan Details</h2>
                <span class="px-3 py-1 rounded-full text-sm
                    @if($loan->status === 'pending') bg-yellow-100 text-yellow-800
                    @elseif($loan->status === 'approved') bg-green-100 text-green-800
                    @elseif($loan->status === 'rejected') bg-red-100 text-red-800
                    @endif">
                    {{ ucfirst($loan->status) }}
                </span>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Loan Information</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Reference:</dt>
                                <dd class="font-medium">{{ $loan->reference }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Amount:</dt>
                                <dd class="font-medium">₦{{ number_format($loan->amount) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Interest Amount:</dt>
                                <dd class="font-medium">₦{{ number_format($loan->interest_amount) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Total Amount:</dt>
                                <dd class="font-medium">₦{{ number_format($loan->total_amount) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Monthly Payment:</dt>
                                <dd class="font-medium">₦{{ number_format($loan->monthly_payment) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Duration:</dt>
                                <dd class="font-medium">{{ $loan->duration }} months</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Member Information</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Name:</dt>
                                <dd class="font-medium">{{ $loan->user->full_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Member No:</dt>
                                <dd class="font-medium">{{ $loan->user->member_no }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Email:</dt>
                                <dd class="font-medium">{{ $loan->user->email }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Phone:</dt>
                                <dd class="font-medium">{{ $loan->user->phone_number }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-4">Guarantors</h3>
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($loan->guarantors as $guarantor)
                        <div class="border rounded-lg p-4">
                            <p class="font-medium">{{ $guarantor->user->full_name }}</p>
                            <p class="text-sm text-gray-600">Status:
                                <span class="font-medium
                                        @if($guarantor->status === 'approved') text-green-600
                                        @elseif($guarantor->status === 'rejected') text-red-600
                                        @else text-yellow-600
                                        @endif">
                                    {{ ucfirst($guarantor->status) }}
                                </span>
                            </p>
                        </div>
                        @endforeach
                    </div>
                </div>

                @if($loan->status === 'pending')
                <div class="border-t pt-6 flex justify-end space-x-4">
                    <button onclick="document.getElementById('rejectModal').classList.remove('hidden')"
                        class="px-4 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50">
                        Reject
                    </button>
                    <form action="{{ route('admin.loans.approve', $loan) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Approve
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Rejection Modal -->
<div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Reject Loan Application</h3>
            <form action="{{ route('admin.loans.reject', $loan) }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection</label>
                    <textarea name="rejection_reason" required rows="3"
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                        Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection