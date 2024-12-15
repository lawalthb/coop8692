@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Pending Guarantor Requests -->
    <div class="bg-white rounded-lg shadow-lg mb-8">
        <div class="px-6 py-4 bg-yellow-50 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Pending Guarantor Requests</h3>
        </div>

        <div class="p-6">
            @forelse($data['pending_requests'] as $request)
                <div class="border rounded-lg p-6 mb-4">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h4 class="font-semibold">Loan Request from {{ $request->loan->user->full_name }}</h4>
                            <p class="text-sm text-gray-600">Amount: ₦{{ number_format($request->loan->amount) }}</p>
                            <p class="text-sm text-gray-600">Duration: {{ $request->loan->duration }} months</p>
                        </div>
                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                            Pending Response
                        </span>
                    </div>

                    <form action="{{ route('member.guarantors.respond', $request) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Your Response</label>
                            <textarea name="comment" required rows="2"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Please provide a reason for your decision"></textarea>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="submit" name="status" value="rejected"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Decline
                            </button>
                            <button type="submit" name="status" value="approved"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Accept
                            </button>
                        </div>
                    </form>
                </div>
            @empty
                <p class="text-gray-500 text-center">No pending guarantor requests</p>
            @endforelse
        </div>
    </div>

    <!-- Past Guarantees -->
    <div class="bg-white rounded-lg shadow-lg">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-700">Past Guarantees</h3>
        </div>

        <div class="p-6">
            @forelse($data['past_guarantees'] as $guarantee)
                <div class="border rounded-lg p-4 mb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h4 class="font-semibold">{{ $guarantee->loan->user->full_name }}</h4>
                            <p class="text-sm text-gray-600">Amount: ₦{{ number_format($guarantee->loan->amount) }}</p>
                            <p class="text-sm text-gray-600">Response Date: {{ $guarantee->responded_at->format('d M, Y') }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-sm
                            @if($guarantee->status === 'approved') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($guarantee->status) }}
                        </span>
                    </div>
                    @if($guarantee->comment)
                        <div class="mt-2 text-sm text-gray-600">
                            <p class="font-medium">Comment:</p>
                            <p>{{ $guarantee->comment }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500 text-center">No past guarantees found</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
