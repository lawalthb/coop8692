@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Saving Details</h2>
            </div>

            <div class="p-6">
                <dl class="grid grid-cols-2 gap-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Member</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $saving->user->full_name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Saving Type</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $saving->savingType->name }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Amount</dt>
                        <dd class="mt-1 text-lg text-gray-900">₦{{ number_format($saving->amount) }}</dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Date</dt>
                        <dd class="mt-1 text-lg text-gray-900">{{ $saving->created_at->format('d M, Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
@endsection
