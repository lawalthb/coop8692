<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ProfileUpdateRequestStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $remarks;

    public function __construct($status, $remarks)
    {
        $this->status = $status;
        $this->remarks = $remarks;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $subject = $this->status === 'approved' ?
            'Profile Update Request Approved' :
            'Profile Update Request Rejected';

        return (new MailMessage)
            ->subject($subject)
            ->greeting('Hello ' . $notifiable->full_name)
            ->line('Your profile update request has been ' . $this->status . '.')
            ->line('Admin Remarks: ' . $this->remarks)
            ->action('View Profile', route('member.profile.show'));
    }

    public function toArray($notifiable)
    {
        return [
            'status' => $this->status,
            'remarks' => $this->remarks
        ];
    }
}
