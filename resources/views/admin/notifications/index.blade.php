@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Notifications</h2>
                <form action="{{ route('admin.notifications.mark-all-read') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-white hover:underline">
                        Mark all as read
                    </button>
                </form>
            </div>

            <div class="divide-y divide-gray-200">
                @forelse(auth()->user()->notifications as $notification)
                    <div class="p-6 {{ $notification->read_at ? 'bg-white' : 'bg-green-50' }}">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <p class="text-sm text-gray-600">
                                    @include('admin.notifications.types.' . snake_case(class_basename($notification->type)))
                                </p>
                                <span class="text-xs text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </span>
                            </div>
                            @unless($notification->read_at)
                                <form action="{{ route('admin.notifications.mark-as-read', $notification) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-sm text-green-600 hover:text-green-800">
                                        Mark as read
                                    </button>
                                </form>
                            @endunless
                        </div>
                    </div>
                @empty
                    <div class="p-6 text-center text-gray-500">
                        No notifications found
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
