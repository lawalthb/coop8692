@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Saving Types</h1>
        <a href="{{ route('admin.saving-types.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Add New Saving Type
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Code</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Interest Rate</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Min Balance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($savingTypes as $type)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $type->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $type->code }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $type->interest_rate }}%</td>
                    <td class="px-6 py-4 whitespace-nowrap">₦{{ number_format($type->minimum_balance) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $type->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $type->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        @if($type->name !== 'Ordinary Savings')
                            <div class="flex space-x-3">
                                <a href="{{ route('admin.saving-types.edit', $type) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Edit</a>

                                <form action="{{ route('admin.saving-types.destroy', $type) }}"
                                      method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this saving type?')"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="text-gray-400">System</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
