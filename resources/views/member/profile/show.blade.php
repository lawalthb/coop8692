@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Personal Information -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-6">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Personal Information</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Member Number</label>
                        <p class="mt-1 text-lg">{{ $data['user']->member_no }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <p class="mt-1 text-lg">{{ $data['user']->title }} {{ $data['user']->full_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-lg">{{ $data['user']->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Join Date</label>
                        <p class="mt-1 text-lg">{{ $data['user']->date_join ? $data['user']->date_join->format('d M, Y') : 'Not set' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Profile Form -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Update Profile</h2>
            </div>
            <form action="{{ route('member.profile.update') }}" method="POST" class="p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone_number" value="{{ old('phone_number', $data['user']->phone_number) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Home Address</label>
                        <textarea name="home_address" rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ old('home_address', $data['user']->home_address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">State</label>
                        <select name="state_id" id="state_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            @foreach($data['states'] as $state)
                                <option value="{{ $state->id }}" {{ $data['user']->state_id == $state->id ? 'selected' : '' }}>
                                    {{ $state->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LGA</label>
                        <select name="lga_id" id="lga_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                            <!-- Will be populated via AJAX -->
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-4">Next of Kin Information</h3>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Name</label>
                        <input type="text" name="nok" value="{{ old('nok', $data['user']->nok) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Relationship</label>
                        <input type="text" name="nok_relationship" value="{{ old('nok_relationship', $data['user']->nok_relationship) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Phone</label>
                        <input type="tel" name="nok_phone" value="{{ old('nok_phone', $data['user']->nok_phone) }}"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Next of Kin Address</label>
                        <textarea name="nok_address" rows="2"
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500">{{ old('nok_address', $data['user']->nok_address) }}</textarea>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const stateSelect = document.getElementById('state_id');
    const lgaSelect = document.getElementById('lga_id');

    function loadLgas(stateId) {
        fetch(`/api/states/${stateId}/lgas`)
            .then(response => response.json())
            .then(lgas => {
                lgaSelect.innerHTML = lgas.map(lga =>
                    `<option value="${lga.id}" ${lga.id == {{ $data['user']->lga_id }} ? 'selected' : ''}>
                        ${lga.name}
                    </option>`
                ).join('');
            });
    }

    stateSelect.addEventListener('change', (e) => loadLgas(e.target.value));
    loadLgas(stateSelect.value); // Load LGAs for initial state
});
</script>
@endpush
@endsection
