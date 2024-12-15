@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Bulk Saving Entry</h2>
            </div>

            <form action="{{ route('admin.savings.bulk-store') }}" method="POST" class="p-6">
                @csrf

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Date</label>
                    <input type="date" name="transaction_date" required
                        class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                </div>

                <div id="entries-container" class="space-y-6">
                    <div class="entry-row grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Member</label>
                            <select name="entries[0][user_id]" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select Member</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->full_name }} ({{ $member->member_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Saving Type</label>
                            <select name="entries[0][saving_type_id]" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select Type</option>
                                @foreach($savingTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                            <input type="number" name="entries[0][amount]" required step="0.01" min="0"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="button" id="add-entry"
                        class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50">
                        Add Another Entry
                    </button>
                </div>

                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('admin.savings.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Record Bulk Savings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let entryCount = 0;

    document.getElementById('add-entry').addEventListener('click', function() {
        entryCount++;
        const template = document.querySelector('.entry-row').cloneNode(true);

        // Update name attributes
        template.querySelectorAll('select, input').forEach(element => {
            element.name = element.name.replace('[0]', `[${entryCount}]`);
            element.value = '';
        });

        document.getElementById('entries-container').appendChild(template);
    });
</script>
@endpush
@endsection
