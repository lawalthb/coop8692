@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">

    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Bulk Saving Entry</h2>
            </div>

            <form action="{{ route('admin.savings.bulk.store') }}" method="POST" class="p-6">
                @csrf





                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Transaction Date</label>
                        <input type="date" name="transaction_date" required
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Month</label>
                        <select name="month_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            @foreach($months as $month)
                            <option value="{{ $month->id }}">{{ $month->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Year</label>
                        <select name="year_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            @foreach($years as $year)
                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <div id="entries-container" class="space-y-4">
                    <div class="entry-row grid grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg relative">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Member</label>

                            <select name="entries[0][user_id]" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select Member</option>
                                @foreach($members as $member)

                                <option value="{{ $member->id }}">{{ $member->full_name }} ({{ $member->member_no }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Saving Type</label>

                            <select name="entries[0][saving_type_id]" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select Type</option>
                                @foreach($savingTypes as $type)

                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                            <input type="number" name="entries[0][amount]" required step="0.01" min="0" value="10000"
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>

                        <button type="button" class="remove-entry absolute -right-2 -top-2 bg-red-100 text-red-600 rounded-full p-1 hover:bg-red-200" title="Remove Entry">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <script>
                    document.addEventListener('click', function(e) {
                        if (e.target.closest('.remove-entry')) {
                            const row = e.target.closest('.entry-row');
                            row.remove();
                        }
                    });
                </script>

                <div class="mt-6 flex items-center space-x-4">
                    <button type="button" id="add-entry"

                        class="px-4 py-2 border border-green-600 text-green-600 rounded-lg hover:bg-green-50 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Another Entry
                    </button>
                </div>


                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('admin.savings.index') }}"

                        class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit"

                        class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
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

        template.querySelectorAll('select, input').forEach(element => {
            element.name = element.name.replace('[0]', `[${entryCount}]`);
            if (element.type === 'number') {
                element.value = '10000';
            } else {
                element.value = '';
            }
        });

        const container = document.getElementById('entries-container');
        container.appendChild(template);

        template.scrollIntoView({
            behavior: 'smooth',
            block: 'end'
        });
    });
</script>
@endpush
@endsection