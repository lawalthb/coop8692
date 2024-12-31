<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class GuarantorRequestNotification extends Notification
{
    use Queueable;

    protected $loan;

    public function __construct($loan)
    {
        $this->loan = $loan;
    }

    public function via($notifiable)
    {
        try {
            return ['mail', 'database'];
        } catch (\Exception $e) {
            return ['database']; // Fallback to database only if mail fails
        }
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Loan Guarantor Request')
            ->line('You have been requested to be a guarantor for a loan application.')
            ->line('Loan Amount: ' . number_format($this->loan->amount, 2))
            ->line('Duration: ' . $this->loan->duration . ' months')
            ->action('Review Request', route('member.loans.guarantor', $this->loan->id))
            ->line('Please review and respond to this request.');
    }

    public function toArray($notifiable)
    {
        return [
            'loan_id' => $this->loan->id,
            'message' => 'You have been requested to be a guarantor for loan ' . $this->loan->reference,
        ];
    }
}
