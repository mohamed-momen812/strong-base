<?php

namespace App\Actions\Auth;

use App\Data\Auth\ResetPasswordData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordAction
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(ResetPasswordData $credentials): string
    {
        $status = Password::reset(
            $credentials->toArray(),
            function (User $user, string $password) {
                $this->userRepository->update($user, [
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60), // for future use for blade
                ]);
            }
        );

        return $status;
    }
}
