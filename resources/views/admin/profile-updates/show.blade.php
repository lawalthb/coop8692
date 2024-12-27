@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Profile Update Request Details</h2>
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    {{ $request->status === 'pending' ? 'bg-yellow-100 text-yellow-800' :
                       ($request->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800') }}">
                    {{ ucfirst($request->status) }}
                </span>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Current Profile -->
                    <div class="border rounded-lg p-6">
                        <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center">
                            <span class="bg-gray-100 p-1 rounded-full mr-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                            Current Profile
                        </h3>
                        <div class="space-y-4">
                            <div class="flex justify-center mb-6">
                                <img src="{{ Storage::url($request->user->member_image) }}" alt="Current Profile"
                                    class="w-20 h-20 rounded-full object-cover border-4 border-gray-100">
                            </div>
                            <div class="grid gap-4">
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Full Name</label>
                                    <p class="text-gray-700">{{ $request->user->title }} {{ $request->user->surname }} {{ $request->user->firstname }} {{ $request->user->othername }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Phone Number</label>
                                    <p class="text-gray-700">{{ $request->user->phone_number }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">Address</label>
                                    <p class="text-gray-700">{{ $request->user->home_address }}</p>
                                </div>
                                <div>
                                    <label class="text-sm font-medium text-gray-500">State & LGA</label>
                                    <p class="text-gray-700">{{ $request->user->state->name ?? '' }} - {{ $request->user->lga->name ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Requested Changes -->
                    <div class="border rounded-lg p-6 bg-green-50">
                        <h3 class="text-lg font-semibold mb-4 text-green-700 flex items-center">
                            <span class="bg-green-100 p-1 rounded-full mr-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </span>
                            Requested Changes
                        </h3>
                        <div class="space-y-4">
                            <!-- Requested Profile Image -->
                            <div class="flex justify-center mb-6">
                                @if($request->member_image)
                                <img src="{{ asset('storage/' . $request->member_image) }}" alt="New Profile"
                                    class="w-12 h-12 rounded-full object-cover border-4 border-green-100">
                                @else
                                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Change</span>
                                </div>
                                @endif
                            </div>
                            <!-- Display all possible fields -->
                            <div class="grid gap-4">
                                @foreach([
                                'title' => 'Title',
                                'surname' => 'Surname',
                                'firstname' => 'First Name',
                                'othername' => 'Other Name',
                                'home_address' => 'Home Address',
                                'gender' => 'Gender',
                                'phone_number' => 'Phone Number',
                                'email' => 'Email',
                                'dob' => 'Date of Birth',
                                'nationality' => 'Nationality',
                                'marital_status' => 'Marital Status',
                                'religion' => 'Religion',
                                'nok' => 'Next of Kin',
                                'nok_relationship' => 'Next of Kin Relationship',
                                'nok_address' => 'Next of Kin Address',
                                'nok_phone' => 'Next of Kin Phone',
                                'monthly_savings' => 'Monthly Savings'
                                ] as $field => $label)
                                <div>
                                    <label class="text-sm font-medium text-green-600">{{ $label }}</label>
                                    <p class="text-gray-700">
                                        {{ $request->$field ?? 'No Change' }}
                                    </p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                @if($request->status === 'pending')
                <div class="mt-8 border-t pt-6">
                    <h3 class="text-lg font-semibold mb-4">Review Decision</h3>
                    <form action="{{ route('admin.profile-updates.reject', $request) }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="profile_request_id" value="{{ $request->id }}">
                        <input type="hidden" name="user_id" value="{{ $request->user_id }}">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Admin Remarks</label>
                            <textarea name="admin_remarks" rows="3" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">Is Good</textarea>
                        </div>

                        <div class="flex justify-end space-x-4">
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                                Reject Request
                            </button>
                            <button type="submit" formaction="{{ route('admin.profile-updates.approve', $request) }}"
                                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                Approve Request
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="mt-8 border-t pt-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-700">Admin Remarks</h4>
                        <p class="mt-1 text-gray-600">{{ $request->admin_remarks }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
