<?php

namespace App\Data\Admin;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class UserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string|Optional $password,
        public string|Optional $password_confirmation,
        public array|Optional $roles
    ) {}

    public static function rules(\Spatie\LaravelData\Support\Validation\ValidationContext $context): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
            'roles' => ['sometimes', 'array'],
            'roles.*' => ['sometimes', 'string', 'exists:roles,name'],
        ];
    }
}
