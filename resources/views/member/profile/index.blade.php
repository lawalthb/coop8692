@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">My Profile</h2>
            </div>

            <div class="p-6 space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1">{{ $member->full_name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1">{{ $member->email }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Phone Number</label>
                        <p class="mt-1">{{ $member->phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nationality</label>
                        <p class="mt-1">{{ $member->nationality }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Marital Status</label>
                        <p class="mt-1">{{ $member->marital_status }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Religion</label>
                        <p class="mt-1">{{ $member->religion }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Next of Kin</label>
                        <p class="mt-1">{{ $member->nok }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Next of Kin Phone</label>
                        <p class="mt-1">{{ $member->nok_phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Next of Kin Relationship</label>
                        <p class="mt-1">{{ $member->nok_relationship }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Next of Kin Address</label>
                        <p class="mt-1">{{ $member->nok_address }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Monthly Savings</label>
                        <p class="mt-1">{{ $member->monthly_savings }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Share Subscription</label>
                        <p class="mt-1">{{ $member->share_subscription }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Month Commenced</label>
                        <p class="mt-1">{{ $member->month_commence }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Date Joined</label>
                        <p class="mt-1">{{ $member->date_join }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Member Number</label>
                        <p class="mt-1">{{ $member->member_no }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Occupation</label>
                        <p class="mt-1">{{ $member->occupation }}</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('member.profile.show') }}"
                       class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
