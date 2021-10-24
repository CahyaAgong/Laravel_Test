<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CompanyNotify extends Notification
{
    use Queueable;

    protected $email;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email)
    {
      $this->email = $email;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mail = $this->email;
        return (new MailMessage)
                    ->from('HRD@company.corps','HRD Company')
                    ->subject('New Employees Added!')
                    ->line('We have successfully added a new employee!')
                    ->line('Contact him/her via email : ' . $this->email . '.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
