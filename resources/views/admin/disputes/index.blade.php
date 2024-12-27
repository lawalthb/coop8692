@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Transaction Disputes</h2>
        </div>

        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th>Member</th>
                        <th>Transaction</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($disputes as $dispute)
                    <tr>
                        <td>{{ $dispute->user->full_name }}</td>
                        <td>{{ $dispute->transaction->reference }}</td>
                        <td>{{ $dispute->description }}</td>
                        <td>{{ ucfirst($dispute->status) }}</td>
                        <td>
                            <button onclick="openResponseModal({{ $dispute->id }})"
                                class="text-green-600 hover:text-green-900">
                                Respond
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Response Modal -->
<div id="responseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden">
    <div class="flex items-center justify-center min-h-screen">
        <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <h3 class="text-lg font-semibold mb-4">Respond to Dispute</h3>
            <form id="disputeResponseForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Admin Response</label>
                    <textarea name="admin_response" rows="3" required
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500"></textarea>
                </div>

                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeResponseModal()"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Submit Response
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openResponseModal(disputeId) {
        const modal = document.getElementById('responseModal');
        const form = document.getElementById('disputeResponseForm');
        form.action = `/admin/disputes/${disputeId}/respond`;
        modal.classList.remove('hidden');
    }

    function closeResponseModal() {
        document.getElementById('responseModal').classList.add('hidden');
    }
</script>
@endpush
@endsection
