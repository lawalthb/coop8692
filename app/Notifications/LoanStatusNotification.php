<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoanStatusNotification extends Notification
{
    use Queueable;

    protected $loan;
    protected $status;

    public function __construct($loan, $status)
    {
        $this->loan = $loan;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Loan Application ' . ucfirst($this->status))
            ->line('Your loan application with reference ' . $this->loan->reference . ' has been ' . $this->status . '.');

        if ($this->status === 'approved') {
            $message->line('Loan Amount: ₦' . number_format($this->loan->amount))
                ->line('Monthly Payment: ₦' . number_format($this->loan->monthly_payment))
                ->line('Duration: ' . $this->loan->duration . ' months');
        } elseif ($this->status === 'rejected') {
            $message->line('Reason: ' . $this->loan->rejection_reason);
        }

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'loan_id' => $this->loan->id,
            'status' => $this->status,
            'reference' => $this->loan->reference
        ];
    }
}
