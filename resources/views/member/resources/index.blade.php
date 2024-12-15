@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Cooperative Resources</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($resources as $resource)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center">
                                @switch($resource->file_type)
                                    @case('pdf')
                                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L12 2Z"/>
                                        </svg>
                                        @break
                                    @case('doc')
                                    @case('docx')
                                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L12 2Z"/>
                                        </svg>
                                        @break
                                    @default
                                        <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2H6C4.89543 2 4 2.89543 4 4V20C4 21.1046 4.89543 22 6 22H18C19.1046 22 20 21.1046 20 20V8L12 2Z"/>
                                        </svg>
                                @endswitch
                            </div>
                            <span class="text-sm text-gray-500">{{ $resource->file_size }}</span>
                        </div>

                        <h3 class="text-lg font-semibold mb-2">{{ $resource->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $resource->description }}</p>

                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-500">
                                Downloads: {{ $resource->download_count }}
                            </span>
                            <a href="{{ route('member.resources.download', $resource) }}"
                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 text-gray-500">
                    No resources available at the moment
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $resources->links() }}
        </div>
    </div>
</div>
@endsection
