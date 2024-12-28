@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">My Profile</h2>
                @if(auth()->user()->profileUpdateRequest && auth()->user()->profileUpdateRequest->status === 'pending')
                <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full">Update Request Pending</span>
                @endif
            </div>

            <form action="{{ route('member.profile.update-request') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <select name="title" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                    @foreach(['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'] as $title)
                                    <option value="{{ $title }}" {{ $user->title === $title ? 'selected' : '' }}>{{ $title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Surname</label>
                                <input type="text" name="surname" value="{{ $user->surname }}" required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" name="firstname" value="{{ $user->firstname }}" required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Other Name</label>
                                <input type="text" name="othername" value="{{ $user->othername }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone_number" value="{{ $user->phone_number }}" required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="dob" value="{{ $user->dob }}" required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Home Address</label>
                                <textarea name="home_address" rows="3" required
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ $user->home_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Additional Information</h3>
                        <div class="space-y-4">
                            <div>

                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture (Required)</label>
                                <input type="file" name="member_image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                                <input type="file" name="signature_image" accept="image/*"
                                    class="w-full border border-gray-300 rounded-lg p-2">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Religion</label>
                                <select name="religion" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                    @foreach(['Christian', 'Islam', 'Traditional'] as $religion)
                                    <option value="{{ $religion }}" {{ $user->religion === $religion ? 'selected' : '' }}>{{ $religion }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Marital Status</label>
                                <select name="marital_status" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                    @foreach(['Single', 'Married', 'Divorced', 'Widowed'] as $status)
                                    <option value="{{ $status }}" {{ $user->marital_status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Hostel Name</label>
                                <input type="text" name="hostel_name" value="{{ $user->hostel_name }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                            <select name="state_id" id="state_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select State</option>
                                @foreach($states as $state)
                                <option value="{{ $state->id }}" {{ $user->state_id == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Local Government Area</label>
                            <select name="lga_id" id="lga_id" required class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                <option value="">Select LGA</option>
                                @foreach($lgas as $lga)
                                <option value="{{ $lga->id }}" data-state="{{ $lga->state_id }}"
                                    {{ $user->lga_id == $lga->id ? 'selected' : '' }}
                                    class="lga-option">
                                    {{ $lga->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Add this inside the Additional Information section -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Occupation</label>
                        <input type="text" name="occupation" value="{{ $user->occupation }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <!-- Next of Kin Information -->
                    <div class="space-y-4">
                        <h4 class="text-md font-semibold text-gray-700">Next of Kin Details</h4>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Name</label>
                            <input type="text" name="nok" value="{{ $user->nok }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Relationship with Next of Kin</label>
                            <input type="text" name="nok_relationship" value="{{ $user->nok_relationship }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Address</label>
                            <textarea name="nok_address" rows="3" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ $user->nok_address }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Phone Number</label>
                            <input type="tel" name="nok_phone" value="{{ $user->nok_phone }}" required
                                class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    @if(auth()->user()->profileUpdateRequest && auth()->user()->profileUpdateRequest->status === 'pending')
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    Your profile update request is currently under review. You cannot submit new changes until this request is processed.
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 disabled:opacity-50 disabled:cursor-not-allowed"
                            {{ auth()->user()->profileUpdateRequest && auth()->user()->profileUpdateRequest->status === 'pending' ? 'disabled' : '' }}>
                            Submit Update Request
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    document.getElementById('state_id').addEventListener('change', function() {
        const stateId = this.value;
        const lgaSelect = document.getElementById('lga_id');
        const lgaOptions = lgaSelect.getElementsByClassName('lga-option');

        Array.from(lgaOptions).forEach(option => {
            if (option.dataset.state === stateId) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none';
            }
        });

        lgaSelect.value = '';
    });
</script>
@endpush
@endsection