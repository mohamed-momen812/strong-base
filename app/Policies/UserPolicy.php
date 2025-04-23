<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, User $model)
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    public function update(User $user, User $model)
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    // Other policy methods...
}