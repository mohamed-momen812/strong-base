<?php

namespace App\Services\Auth;

use App\Data\Auth\LoginData;
use App\Models\Admin;

interface AdminAuthServiceInterface
{
    public function login(LoginData $data): array;
    public function logout(): void;
    public function getUser(): ?Admin;
}
