@extends('layouts.member')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600 flex justify-between items-center">
                <h2 class="text-xl font-bold text-white">Notifications</h2>
                @if(auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('member.notifications.markAllAsRead') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-white hover:text-green-100">
                        Mark all as read
                    </button>
                </form>
                @endif
            </div>

            <div class="divide-y divide-gray-200">
                @forelse($notifications as $notification)
                <div class="p-6 @if(!$notification->read_at) bg-green-50 @endif">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center mb-2">
                                <span class="font-medium">{{ $notification->data['title'] ?? 'Notification' }}</span>
                                @if(!$notification->read_at)
                                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">New</span>
                                @endif
                            </div>
                            <p class="text-gray-600">
                                <p class="text-gray-600">
                                    @if(isset($notification->data['type']) && $notification->data['type'] === 'savings')
                                        A savings deposit of ₦{{ number_format($notification->data['amount'], 2) }} has been recorded for {{ $notification->data['saving_type'] }}.
                                        Reference: {{ $notification->data['reference'] }}
                                    @else
                                        {{ $notification->data['message'] ?? $notification->data['body'] ?? 'No message content' }}
                                    @endif
                                </p>
                            </p>

                        </div>
                        @if(!$notification->read_at)
                        <form action="{{ route('member.notifications.markAsRead', $notification->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-sm text-green-600 hover:text-green-700">
                                Mark as read
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @empty
                <div class="p-6 text-center text-gray-500">
                    No notifications found
                </div>
                @endforelse
            </div>

            @if($notifications->hasPages())
            <div class="px-6 py-4 border-t">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
