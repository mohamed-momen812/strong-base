<?php

namespace App\Actions\User;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailAction
{
    public function execute(User $user): void
    {
        Mail::to($user->email)
            ->queue(new WelcomeEmail($user));
    }
}