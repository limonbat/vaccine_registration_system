<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VaccineScheduleSmsNotification extends Notification
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toSms($notifiable)
    {
        /*
         * ========== SMS code  ================
         *
         */
    }

}
