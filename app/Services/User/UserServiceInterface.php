<?php

namespace App\Services\Contracts;

use App\Data\User\UserData;
use App\Data\User\CreateUserData;
use App\Models\User;

interface UserServiceInterface
{
    public function create(CreateUserData $data): User;
    public function update(User $user, UserData $data): User;
    public function delete(User $user): bool;
}
