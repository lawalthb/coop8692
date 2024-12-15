<div class="flex items-start">
    <div class="flex-1">
        <p class="font-medium">Guarantor Request</p>
        <p>You have been requested to be a guarantor for loan reference: {{ $notification->data['loan_reference'] }}</p>
        <p class="text-sm text-gray-600">Member: {{ $notification->data['member_name'] }}</p>
    </div>
</div>
