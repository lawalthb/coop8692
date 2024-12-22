@extends('layouts.member')

@section('content')
<div class="bg-white rounded-lg shadow-sm">
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Guarantor Requests</h2>

        @if($guarantorRequests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Loan ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Borrower</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($guarantorRequests as $request)
                            <tr>
                                <td class="px-6 py-4">{{ $request->loan->loan_id }}</td>
                                <td class="px-6 py-4">{{ $request->loan->user->full_name }}</td>
                                <td class="px-6 py-4">₦{{ number_format($request->loan->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $request->status === 'approved' ? 'bg-green-100 text-green-800' :
                                           ($request->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($request->status === 'pending')
                                        <div class="flex space-x-2">
                                            <form action="{{ route('member.loans.guarantor.approve', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-green-600 hover:text-green-900">Approve</button>
                                            </form>
                                            <form action="{{ route('member.loans.guarantor.reject', $request->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                                            </form>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-500">No guarantor requests found.</p>
        @endif
    </div>
</div>
@endsection
