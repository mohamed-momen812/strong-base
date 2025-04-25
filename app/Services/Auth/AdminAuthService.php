<?php

namespace App\Services\Auth;

use App\Actions\Auth\LoginAction;
use App\Data\Auth\LoginData;
use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthService implements AdminAuthServiceInterface
{
    public function __construct(
        private AdminRepositoryInterface $adminRepository
    ) {}

    public function login(LoginData $data): array
    {
        $admin = $this->adminRepository->findByEmail($data->email);

        if (!$admin || !Hash::check($data->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')], // this message is default in Laravel conterted to These credentials do not match our records.
            ]);
        }


        $token = $admin->createToken('admin_auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'admin' => $admin,
        ];
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }

    public function getUser(): ?Admin
    {
        return Auth::guard('admin')->user();
    }
}
