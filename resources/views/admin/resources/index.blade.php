@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Resources Management</h1>
        <a href="{{ route('admin.resources.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Upload New Resource
        </a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Size</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Downloads</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded By</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($resources as $resource)
                <tr>
                    <td class="px-6 py-4">{{ $resource->title }}</td>
                    <td class="px-6 py-4">{{ $resource->file_type }}</td>
                    <td class="px-6 py-4">{{ number_format($resource->file_size / 1024, 2) }} KB</td>
                    <td class="px-6 py-4">{{ $resource->download_count }}</td>
                    <td class="px-6 py-4">{{ $resource->uploadedBy->full_name }}</td>
                    <td class="px-6 py-4 flex space-x-3">
                        <a href="{{ Storage::url($resource->file_path) }}" target="_blank"
                            class="text-blue-600 hover:text-blue-900">Download</a>
                        <form action="{{ route('admin.resources.destroy', $resource) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this resource?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-6 py-4">
            {{ $resources->links() }}
        </div>
    </div>
</div>
@endsection
