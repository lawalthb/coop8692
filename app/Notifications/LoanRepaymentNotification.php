<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LoanRepaymentNotification extends Notification
{
    use Queueable;

    protected $loan;
    protected $repayment;

    public function __construct($loan, $repayment)
    {
        $this->loan = $loan;
        $this->repayment = $repayment;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Loan Repayment Recorded')
            ->line('A repayment has been recorded for your loan.')
            ->line('Amount: ₦' . number_format($this->repayment->amount, 2))
            ->line('Payment Date: ' . $this->repayment->payment_date->format('d M, Y'))
            ->line('Reference: ' . $this->repayment->reference)
            ->action('View Loan Details', route('member.loans.show', $this->loan->id));
    }

    public function toArray($notifiable)
    {
        return [
            'loan_id' => $this->loan->id,
            'amount' => $this->repayment->amount,
            'message' => 'Loan repayment of ₦' . number_format($this->repayment->amount, 2) . ' has been recorded'
        ];
    }
}
