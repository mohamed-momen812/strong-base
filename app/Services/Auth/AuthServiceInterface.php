<?php

namespace App\Services\Auth;

use App\Data\Auth\ForgotPasswordData;
use App\Data\Auth\LoginData;
use App\Data\Auth\RegisterData;
use App\Data\Auth\ResetPasswordData;
use App\Models\User;
use Illuminate\Http\Request;

interface AuthServiceInterface
{
    public function login(LoginData $data): array;
    public function register(RegisterData $data): User;
    public function logout(): void;
    public function getUser(): ?User;
    public function forgotPassword(ForgotPasswordData $data): string;
    public function resetPassword(ResetPasswordData $data): string;
    public function sendEmailVerification(User $user): void;
    public function verifyEmail(Request $request): void;
}
