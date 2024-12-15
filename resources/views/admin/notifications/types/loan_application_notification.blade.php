<div class="flex items-start">
    <div class="flex-1">
        <p class="font-medium">New Loan Application</p>
        <p>A new loan application has been submitted. Reference: {{ $notification->data['reference'] }}</p>
        <p class="text-sm text-gray-600">Amount: ₦{{ number_format($notification->data['amount']) }}</p>
    </div>
</div>
