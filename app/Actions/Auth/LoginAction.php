<?php

namespace App\Actions\Auth;

use App\Data\Auth\LoginData;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginAction
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(LoginData $data): array
    {
        $user = $this->userRepository->findByEmail($data->email);

        if (!$user || !Hash::check($data->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')], // this message is default in Laravel conterted to These credentials do not match our records.
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ];
    }

}
