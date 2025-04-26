<?php

namespace App\Actions\Admin\Users;

use App\Data\Admin\UserData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CreateUserAction
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(UserData $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => bcrypt($data->password),
            ]);

            if ($data->roles) {
                $user->syncRoles($data->roles);
            }

            return $user;
        });
    }
}
