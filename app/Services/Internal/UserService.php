<?php

namespace App\Services\Internal;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Contracts\UserServiceInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        
        return $this->userRepository->create($data);
    }

    public function getUserById(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }

    public function getAllUsers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->getAllPaginated($perPage);
    }

    public function updateUser(int $userId, array $data): User
    {
        $user = $this->userRepository->findById($userId);
        
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        return $this->userRepository->update($user, $data);
    }

    public function deleteUser(int $userId): bool
    {
        $user = $this->userRepository->findById($userId);
        return $this->userRepository->delete($user);
    }

    public function searchUsers(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->search($query, $perPage);
    }

    public function restoreUser(int $userId): User
    {
        $this->userRepository->withTrashed();
        $user = $this->userRepository->findById($userId);
        
        if ($user->trashed()) {
            $user->restore();
        }
        
        return $user;
    }

    public function forceDeleteUser(int $userId): bool
    {
        $this->userRepository->withTrashed();
        $user = $this->userRepository->findById($userId);
        return $user->forceDelete();
    }
}