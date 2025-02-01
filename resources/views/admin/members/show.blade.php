@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

<div class="px-6 py-4 bg-green-600 flex justify-between items-center">
    <h2 class="text-xl font-bold text-white">Member Details</h2>
    <div class="flex space-x-4">
              @if(Auth::user()->admin_role === 'super_admin' || Auth::user()->admin_role === 'admin' )
        @if(!$member->is_approved)
            <form action="{{ route('admin.members.approve', $member) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-white text-green-600 px-4 py-2 rounded-lg hover:bg-green-50">
                    Approve Member
                </button>
            </form>
        @endif
        @endif
    @if(Auth::user()->admin_role === 'super_admin' )
        @if($totalSavings == 0)
            <form action="{{ route('admin.members.destroy', $member) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this member?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    Delete Member
                </button>
            </form>
        @endif
        @endif
    </div>
</div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Member No:</dt>
                                <dd class="font-medium">{{ $member->member_no }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Full Name:</dt>
                                <dd class="font-medium">{{ $member->full_name }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Email:</dt>
                                <dd class="font-medium">{{ $member->email }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Phone:</dt>
                                <dd class="font-medium">{{ $member->phone_number }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Gender:</dt>
                                <dd class="font-medium">{{ ucfirst($member->gender) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">State:</dt>
                                <dd class="font-medium">{{ $member->state->name ?? 'N/A' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">LGA:</dt>
                                <dd class="font-medium">{{ $member->lga->name ?? 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-4">Account Information</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Monthly Savings:</dt>
                                <dd class="font-medium">₦{{ number_format($member->monthly_savings) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Share Subscription:</dt>
                                <dd class="font-medium">₦{{ number_format($member->share_subscription) }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Date Joined:</dt>
                                <dd class="font-medium">{{ $member->created_at ? $member->created_at->format('d M, Y') : 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Recent Loans</h3>
                    @if($member->loans->count() > 0)
                        <div class="space-y-4">
                            @foreach($member->loans->take(5) as $loan)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="font-medium">{{ $loan->reference }}</p>
                                            <p class="text-sm text-gray-600">Amount: ₦{{ number_format($loan->amount) }}</p>
                                        </div>
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                                            @if($loan->status === 'active') bg-blue-100 text-blue-800
                                            @elseif($loan->status === 'completed') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No loans found</p>
                    @endif
                </div>

                <div class="flex justify-between">
    <dt class="text-gray-600">Total Savings:</dt>
    <dd class="font-medium">₦{{ number_format($totalSavings, 2) }}</dd>
</div>
            </div>
        </div>
    </div>
</div>
@endsection


