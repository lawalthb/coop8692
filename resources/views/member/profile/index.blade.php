@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">My Profile</h2>
            </div>

            <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                                <select name="title" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                                    @foreach(['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'] as $title)
                                        <option value="{{ $title }}" {{ $user->title === $title ? 'selected' : '' }}>
                                            {{ $title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone_number" value="{{ $user->phone_number }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                                <input type="date" name="dob" value="{{ $user->dob }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Home Address</label>
                                <textarea name="home_address" rows="3"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ $user->home_address }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Next of Kin Information -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Next of Kin Details</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Name</label>
                                <input type="text" name="nok" value="{{ $user->nok }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                                <input type="text" name="nok_relationship" value="{{ $user->nok_relationship }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Phone</label>
                                <input type="tel" name="nok_phone" value="{{ $user->nok_phone }}"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Address</label>
                                <textarea name="nok_address" rows="3"
                                    class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ $user->nok_address }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Upload -->
                <div class="mt-8">
                    <h3 class="text-lg font-semibold mb-4">Documents</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                            <input type="file" name="member_image" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg p-2">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Signature</label>
                            <input type="file" name="signature_image" accept="image/*"
                                class="w-full border border-gray-300 rounded-lg p-2">
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
