<?php

namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Repositories\Contracts\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function __construct(private Admin $model) {}

    public function findByEmail(string $email): ?Admin
    {
        return $this->model->where('email', $email)->first();
    }
}
