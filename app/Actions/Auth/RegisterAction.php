<?php

namespace App\Actions\Auth;

use App\Data\Auth\RegisterData;
use App\Repositories\Contracts\UserRepositoryInterface;

class RegisterAction
{
    public function __construct(private UserRepositoryInterface $userRepository) {}

    public function execute(RegisterData $data)
    {
        return $this->userRepository->create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
        ]);
    }
}
