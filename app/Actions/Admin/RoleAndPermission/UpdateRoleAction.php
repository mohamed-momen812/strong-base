<?php

namespace App\Actions\Admin\RoleAndPermission;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UpdateRoleAction
{
    public function execute(Role $role, array $data): Role
    {
        return DB::transaction(function () use ($role, $data) {
            $role->update([
                'name' => $data['name'],
                'guard_name' => $data['guard_name'],
            ]);

            if($data['permissions'] != null){
                $permissions = Permission::whereIn('name', $data['permissions'])->get();
                foreach ($permissions as $permission) {
                    $role->givePermissionTo($permission);
                } // can't use syncPermissions here because it will remove all permissions first
            }
            return $role;
        });
    }
}
