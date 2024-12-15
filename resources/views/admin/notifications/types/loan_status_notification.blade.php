<div class="flex items-start">
    <div class="flex-1">
        <p class="font-medium">Loan Status Update</p>
        <p>Loan application {{ $notification->data['reference'] }} has been {{ $notification->data['status'] }}</p>
    </div>
</div>
