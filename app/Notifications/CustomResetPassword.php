<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;
    public $frontendUrl;

    public function __construct($token)
    {
        $this->token = $token;
        $this->frontendUrl = config('app.frontend_url');
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(Lang::get('إعادة تعيين كلمة المرور'))
            ->line(Lang::get('أنت تتلقى هذا البريد لأننا تلقينا طلب إعادة تعيين كلمة المرور لحسابك.'))
            ->action(
                Lang::get('إعادة تعيين كلمة المرور'),
                url("{$this->frontendUrl}/reset-password?token={$this->token}&email=".urlencode($notifiable->email))
            )
            ->line(Lang::get('إذا لم تطلب إعادة التعيين، لا داعي لاتخاذ أي إجراء.'));
    }
}
