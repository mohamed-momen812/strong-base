<?php

namespace App\Services\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserServiceInterface
{
    public function registerUser(array $data): User;
    public function getUserById(int $id): ?User;
    public function getAllUsers(int $perPage = 15): LengthAwarePaginator;
    public function updateUser(int $userId, array $data): User;
    public function deleteUser(int $userId): bool;
    public function searchUsers(string $query, int $perPage = 15): LengthAwarePaginator;
    public function restoreUser(int $userId): User;
    public function forceDeleteUser(int $userId): bool;
}