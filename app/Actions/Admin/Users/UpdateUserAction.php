<?php

namespace App\Actions\Admin;

use App\Data\Admin\UserData;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UpdateUserAction
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {}

    public function execute(User $user, UserData $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $updateData = [
                'name' => $data->name,
                'email' => $data->email,
            ];

            if ($data->password) {
                $updateData['password'] = bcrypt($data->password);
            }

            $this->userRepository->update($user, $updateData);

            if ($data->roles) {
                $user->syncRoles($data->roles);
            }

            return $user->refresh();
        });
    }
}
