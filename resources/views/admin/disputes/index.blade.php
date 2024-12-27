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
@endsection
