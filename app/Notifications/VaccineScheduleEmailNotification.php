<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccineScheduleEmailNotification extends Notification
{
    use Queueable;
    protected $scheduleDate;
    public function __construct($scheduleDate)
    {
        $this->scheduleDate = $scheduleDate;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Upcoming Vaccination Reminder')
            ->line('This is a reminder that your vaccination is scheduled for ' . $this->scheduleDate . '.')
            ->line('Please make sure to arrive on time.');
    }
}
