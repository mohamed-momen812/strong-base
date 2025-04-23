<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Welcome to Our Platform')
                    ->line('Thank you for registering with us!')
                    ->action('Get Started', url('/dashboard'))
                    ->line('We hope you enjoy our services.');
    }

    public function toArray($notifiable)
    {
        return [
            'message' => 'Welcome to our platform!',
            'action_url' => url('/dashboard'),
        ];
    }
}