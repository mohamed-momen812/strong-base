<?php

namespace App\Actions\Admin\RoleAndPermission;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CreateRoleAction
{
    public function execute(array $data): Role
    {
        return DB::transaction(function () use ($data) {
            $role = Role::create(['name' => $data['name'], 'guard_name' => $data['guard_name']]);

            if (isset($data['permissions'])) {
                $role->syncPermissions($data['permissions']);
            }

            return $role;
        });
    }
}
