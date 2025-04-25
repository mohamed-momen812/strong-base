<?php

namespace App\Actions\Auth;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Password;

class ForgotPasswordAction
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(string $email): string
    {
        $user = $this->userRepository->findByEmail($email);

        if (!$user) {
            return Password::INVALID_USER;
        }

        $status = Password::sendResetLink(['email' => $email]);

        return $status;
    }
}
