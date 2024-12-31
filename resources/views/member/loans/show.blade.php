@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Loan Application Details</h2>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Applicant</label>
                        <p class="mt-1">{{ $loan->user->full_name }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Amount</label>
                        <p class="mt-1">₦{{ number_format($loan->amount, 2) }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Loan Type</label>
                        <p class="mt-1">{{ $loan->loanType->name }}</p>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Duration</label>
                        <p class="mt-1">{{ $loan->duration }} months</p>
                    </div>

                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-700">Purpose</label>
                        <p class="mt-1">{{ $loan->purpose }}</p>
                    </div>
                    <div class="col-span-2">
                        <label class="text-sm font-medium text-gray-700">Loan Status</label>
                    
                    </div>
                </div>

                @if($loan->guarantors->contains('user_id', auth()->id()))
                @php
                $myGuarantee = $loan->guarantors->where('user_id', auth()->id())->first();
                @endphp

                @if($myGuarantee->status === 'pending')
                <div class="flex justify-end space-x-4 mt-8">
                    <form action="{{ route('member.loans.guarantor.respond', $loan) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="response" value="rejected">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Reject
                        </button>
                    </form>

                    <form action="{{ route('member.loans.guarantor.respond', $loan) }}" method="POST" class="inline">
                        @csrf
                        <input type="hidden" name="response" value="approved">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Approve
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-8 p-4 rounded-lg {{ $myGuarantee->status === 'approved' ? 'bg-green-100' : 'bg-red-100' }}">
                    <p class="text-center">You have {{ $myGuarantee->status }} this loan application</p>
                </div>
                @endif
                @endif
            </div>
        </div>
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Guarantors</h3>
            <div class="bg-white shadow overflow-hidden rounded-md">
                <ul class="divide-y divide-gray-200">
                    @foreach($loan->guarantors as $guarantor)
                    <li class="px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $guarantor->user->full_name }}</p>
                                <p class="text-sm text-gray-500">{{ $guarantor->user->email }}</p>
                            </div>
                            <span class="px-3 py-1 text-sm rounded-full
                            @if($guarantor->status === 'approved') bg-green-100 text-green-800
                            @elseif($guarantor->status === 'rejected') bg-red-100 text-red-800
                            @else bg-yellow-100 text-yellow-800
                            @endif">
                                {{ ucfirst($guarantor->status) }}
                            </span>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
