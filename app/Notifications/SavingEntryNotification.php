<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SavingEntryNotification extends Notification
{
    protected $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Saving Transaction Recorded')
            ->line('A saving of ₦' . number_format($this->transaction->credit_amount, 2) . ' has been recorded.')
            ->line('Transaction Reference: ' . $this->transaction->reference)
            ->line('Date: ' . $this->transaction->transaction_date->format('d M, Y'))
            ->line('Current Balance: ₦' . number_format($this->transaction->balance, 2));
    }
    public function toArray($notifiable)
    {
        return [
            'type' => 'savings',
            'amount' => $this->transaction->credit_amount,
            'saving_type' => $this->transaction->transactionable->savingType->name,
            'reference' => $this->transaction->reference,
            'title' => 'Savings Entry',
            'message' => "A savings deposit of ₦" . number_format($this->transaction->credit_amount, 2) . " has been recorded"
        ];
    }
}
