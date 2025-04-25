<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Notifications\SendEmailVerificationNotification;

class SendEmailVerificationAction
{
    public function execute(User $user): void
    {
        $user->notify(new SendEmailVerificationNotification());
    }
}
