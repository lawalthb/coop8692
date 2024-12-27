@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-green-600">
            <h2 class="text-xl font-bold text-white">Savings Report</h2>
        </div>

        <div class="p-6">
            <!-- Filter Form -->
            <div class="mb-6">
                <form action="{{ route('admin.reports.savings') }}" method="GET" class="flex flex-col md:flex-row md:items-end md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Member</label>
                        <select name="member_id" class="w-full rounded-lg border-gray-300">
                            <option value="">All Members</option>
                            @foreach($members as $member)
                                <option value="{{ $member->id }}" {{ request('member_id') == $member->id ? 'selected' : '' }}>
                                    {{ $member->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Saving Type</label>
                        <select name="saving_type_id" class="w-full rounded-lg border-gray-300">
                            <option value="">All Types</option>
                            @foreach($savingTypes as $type)
                                <option value="{{ $type->id }}" {{ request('saving_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">From Date</label>
                        <input type="date" name="date_from" class="w-full rounded-lg border-gray-300" value="{{ request('date_from') }}">
                    </div>

                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-1">To Date</label>
                        <input type="date" name="date_to" class="w-full rounded-lg border-gray-300" value="{{ request('date_to') }}">
                    </div>

                    <div>
                        <button type="submit" class="w-full md:w-auto px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-green-700">Total Savings</h3>
                    <p class="text-2xl font-bold text-green-600">₦{{ number_format($savings->sum('amount'), 2) }}</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-blue-700">Total Entries</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $savings->count() }}</p>
                </div>
                <div class="bg-purple-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-purple-700">Average Saving</h3>
                    <p class="text-2xl font-bold text-purple-600">₦{{ number_format($savings->avg('amount'), 2) }}</p>
                </div>
            </div>

            <!-- Savings Table -->
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Member</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase">Reference</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($savings as $saving)
                    <tr>
                        <td class="px-6 py-4">{{ $saving->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">{{ $saving->user->full_name }}</td>
                        <td class="px-6 py-4">{{ $saving->savingType->name }}</td>
                        <td class="px-6 py-4">₦{{ number_format($saving->amount, 2) }}</td>
                        <td class="px-6 py-4">{{ $saving->reference }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $savings->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
