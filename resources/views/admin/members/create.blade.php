@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Create New Member</h2>
            </div>

            <form action="{{ route('admin.members.store') }}" method="POST" class="p-6">
                @csrf
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Title</label>
                        <select name="title" required class="mt-1 block w-full rounded-md border-gray-300 ">
                            @foreach(['Mr.', 'Mrs.', 'Ms.', 'Dr.', 'Prof.'] as $title)
                                <option value="{{ $title }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Surname</label>
                        <input type="text" name="surname" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <input type="text" name="firstname" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Other Name</label>
                        <input type="text" name="othername" class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone_number" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" name="password" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" required class="mt-1 block w-full rounded-md border-gray-300">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">State</label>
                        <select name="state_id" id="state_id" required class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">LGA</label>
                        <select name="lga_id" id="lga_id" required class="mt-1 block w-full rounded-md border-gray-300">
                            <option value="">Select LGA</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">
                        Create Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('state_id').addEventListener('change', function() {
        const stateId = this.value;
        const lgaSelect = document.getElementById('lga_id');

        fetch(`/lgas/${stateId}`)
            .then(response => response.json())
            .then(data => {
                lgaSelect.innerHTML = '<option value="">Select LGA</option>';
                data.forEach(lga => {
                    lgaSelect.innerHTML += `<option value="${lga.id}">${lga.name}</option>`;
                });
            });
    });
</script>
@endpush
