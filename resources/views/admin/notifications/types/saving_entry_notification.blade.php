<div class="flex items-start">
    <div class="flex-1">
        <p class="font-medium">New Saving Entry</p>
        <p>A saving of ₦{{ number_format($notification->data['amount']) }} has been recorded.
           Reference: {{ $notification->data['reference'] }}</p>
    </div>
</div>
