<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DisputeResponseNotification extends Notification
{
    use Queueable;

    protected $dispute;

    public function __construct($dispute)
    {
        $this->dispute = $dispute;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Transaction Dispute Response')
            ->greeting('Hello ' . $notifiable->full_name)
            ->line('Your transaction dispute has been reviewed.')
            ->line('Transaction Reference: ' . $this->dispute->transaction->reference)
            ->line('Admin Response: ' . $this->dispute->admin_response)
            ->action('View Details', url('/member/transactions'));
    }

    public function toArray($notifiable)
    {
        return [
            'dispute_id' => $this->dispute->id,
            'message' => 'Admin has responded to your transaction dispute',
            'admin_response' => $this->dispute->admin_response
        ];
    }
}
