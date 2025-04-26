<?php

namespace App\Actions\Admin\RoleAndPermission;

use Spatie\Permission\Models\Role;

class SyncPermissionsAction
{
    public function execute(Role $role, array $data): Role
    {
        $role->syncPermissions($data['permissions']);
        return $role;
    }
}
