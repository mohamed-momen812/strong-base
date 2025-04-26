<?php

namespace App\Actions\Admin\RoleAndPermission;

use Spatie\Permission\Models\Role;

class DeleteRoleAction
{
    public function execute(Role $role): void
    {
        $role->delete();
    }
}

