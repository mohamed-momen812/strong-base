<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeedr extends Seeder
{
    public function run()
    {
        // delete all roles and permissions to reset the database
        DB::table('roles')->delete();
        DB::table('permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('model_has_roles')->delete();
        DB::table('model_has_permissions')->delete();

        // create permissions for all modules
        $moduleCollection = collect([
            'user',
            'product',
            'order',
            'cart',
            'category',
            'permissions',
            'roles',
        ]);

        // Create roles
        $superAdminRole  = Role::create(['name' => 'super-admin', 'guard_name' => 'admin']);
        $adminRole  = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $userRole  = Role::create(['name' => 'user', 'guard_name' => 'api']);

        // loop through modules and create permissions
        $moduleCollection->each(function ($module) {

            // Admin permissions
            Permission::firstOrCreate([
                'name' => "admin.$module.viewAny",
                'guard_name' => 'admin',
            ]);
            Permission::firstOrCreate([
                'name' => "admin.$module.view",
                'guard_name' => 'admin',
            ]);
            Permission::firstOrCreate([
                'name' => "admin.$module.create",
                'guard_name' => 'admin',
            ]);
            Permission::firstOrCreate([
                'name' => "admin.$module.update",
                'guard_name' => 'admin',
            ]);
            Permission::firstOrCreate([
                'name' => "admin.$module.delete",
                'guard_name' => 'admin',
            ]);

            // User permissions
            Permission::firstOrCreate([
                'name' => "$module.viewAny",
                'guard_name' => 'api',
            ]);
            Permission::firstOrCreate([
                'name' => "$module.view",
                'guard_name' => 'api',
            ]);
            Permission::firstOrCreate([
                'name' => "$module.create",
                'guard_name' => 'api',
            ]);
            Permission::firstOrCreate([
                'name' => "$module.update",
                'guard_name' => 'api',
            ]);
            Permission::firstOrCreate([
                'name' => "$module.delete",
                'guard_name' => 'api',
            ]);
        });

        // Assign all admin permissions to super-admin
        $superAdminPermissions = [];
        $moduleCollection->each(function ($module) use (&$superAdminPermissions) {
            $superAdminPermissions[] = Permission::where('name', "admin.$module.viewAny")->first();
            $superAdminPermissions[] = Permission::where('name', "admin.$module.view")->first();
            $superAdminPermissions[] = Permission::where('name', "admin.$module.create")->first();
            $superAdminPermissions[] = Permission::where('name', "admin.$module.update")->first();
            $superAdminPermissions[] = Permission::where('name', "admin.$module.delete")->first();
        });

        $superAdminRole->syncPermissions($superAdminPermissions);

        // Assign some admin permissions to admin
        $adminPermissions = [];
        $moduleCollection->each(function ($module) use (&$adminPermissions) {
            $adminPermissions[] = Permission::where('name', "admin.$module.viewAny")->first();
            $adminPermissions[] = Permission::where('name', "admin.$module.view")->first();
        });

        $adminRole->syncPermissions($adminPermissions);
    }
}
