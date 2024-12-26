@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Pending Requests Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Pending Guarantor Requests</h2>
        </div>

        <div class="p-6">
            @if($pendingRequests->count() > 0)
            <div class="space-y-4">
                @foreach($pendingRequests as $request)
                <div class="border rounded-lg p-4 flex justify-between items-center">
                    <div>
                        <p class="font-medium">{{ $request->loan->user->full_name }}</p>
                        <p class="text-sm text-gray-600">Amount: ₦{{ number_format($request->loan->amount, 2) }}</p>
                        <p class="text-sm text-gray-600">Type: {{ $request->loan->loanType->name }}</p>
                    </div>
                    <a href="{{ route('member.loans.show', $request->loan) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        View Details
                    </a>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-center text-gray-600">No pending guarantor requests</p>
            @endif
        </div>
    </div>

    <!-- Approved Guarantor History Section -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Guarantor History</h2>
        </div>

        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Member</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Loan Type</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($approvedRequests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $request->loan->user->full_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $request->loan->loanType->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">₦{{ number_format($request->loan->amount, 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $request->loan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $request->responded_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No approved guarantor history found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
