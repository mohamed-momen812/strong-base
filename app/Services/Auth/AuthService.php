<?php

namespace App\Services\Auth;

use App\Actions\Auth\ForgotPasswordAction;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\ResetPasswordAction;
use App\Actions\Auth\SendEmailVerificationAction;
use App\Actions\Auth\VerifyEmailAction;
use App\Data\Auth\ForgotPasswordData;
use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Data\Auth\ResetPasswordData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        private LoginAction $loginAction,
        private RegisterAction $registerAction,
        private UserRepositoryInterface $userRepository,
        private ForgotPasswordAction $forgotPasswordAction,
        private ResetPasswordAction $resetPasswordAction,
        private SendEmailVerificationAction $sendEmailVerificationAction,
        private VerifyEmailAction $verifyEmailAction
    ) {}

    public function login(LoginData $data): array
    {
        return $this->loginAction->execute($data);
    }

    public function register(RegisterData $data): User
    {
        return $this->registerAction->execute($data);
    }

    public function logout(): void
    {
        Auth::guard('api')->user()->currentAccessToken()->delete();
    }

    public function getUser(): ?User
    {
        return Auth::guard('api')->user();
    }

    public function forgotPassword(ForgotPasswordData $data): string
    {
        return $this->forgotPasswordAction->execute($data->email);
    }

    public function resetPassword(ResetPasswordData $data): string
    {
        return $this->resetPasswordAction->execute($data);
    }

    public function sendEmailVerification(User $user): void
    {
        $this->sendEmailVerificationAction->execute($user);
    }

    public function verifyEmail(Request $request): void
    {
        $this->verifyEmailAction->execute($request);
    }
}
