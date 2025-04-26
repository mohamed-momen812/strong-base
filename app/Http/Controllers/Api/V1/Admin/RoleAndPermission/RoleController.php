<?php

namespace App\Http\Controllers\Api\V1\Admin\RoleAndPermission;

use App\Actions\Admin\RoleAndPermission\CreateRoleAction;
use App\Actions\Admin\RoleAndPermission\DeleteRoleAction;
use App\Actions\Admin\RoleAndPermission\SyncPermissionsAction;
use App\Actions\Admin\RoleAndPermission\UpdateRoleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\RoleAndPermission\StoreRoleRequest;
use App\Http\Requests\Api\V1\RoleAndPermission\SyncPermissionsRequest;
use App\Http\Requests\Api\V1\RoleAndPermission\UpdateRoleRequest;
use App\Http\Resources\Api\V1\RoleAndPermission\RoleResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $roles = Role::with('permissions')->get();
        return RoleResource::collection($roles);
    }

    public function store(StoreRoleRequest $request, CreateRoleAction $createRole): RoleResource
    {
        $role = $createRole->execute($request->validated());
        return new RoleResource($role->load('permissions'));
    }

    public function show(Role $role): RoleResource
    {
        return new RoleResource($role->load('permissions'));
    }

    public function update(UpdateRoleRequest $request, Role $role, UpdateRoleAction $updateRole): RoleResource
    {
        $role = $updateRole->execute($role, $request->validated());
        return new RoleResource($role->load('permissions'));
    }

    public function destroy( Role $role, DeleteRoleAction $deleteRole )
    {
        $deleteRole->execute($role);
        return response()->noContent();
    }


    public function syncPermissions(SyncPermissionsRequest $request, Role $role, SyncPermissionsAction $syncPermissions): RoleResource
    {
        $role = $syncPermissions->execute($role, $request->validated());
        return new RoleResource($role->load('permissions'));
    }
}
