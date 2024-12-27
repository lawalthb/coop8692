<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DisputeSubmittedNotification extends Notification
{
    use Queueable;

    protected $dispute;
    protected $status;

    public function __construct($dispute, $status)
    {
        $this->dispute = $dispute;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Transaction Dispute Submitted')
            ->line('Your transaction dispute has been submitted successfully.')
            ->line('Transaction Reference: ' . $this->dispute->transaction->reference)
            ->line('Status: ' . ucfirst($this->status))
            ->action('View Dispute', url('/member/disputes'));
    }

    public function toArray($notifiable)
    {
        return [
            'dispute_id' => $this->dispute->id,
            'status' => $this->status,
            'message' => 'Transaction dispute submitted'
        ];
    }
}
