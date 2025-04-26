<?php

namespace App\Http\Controllers\Api\V1\Admin\RoleAndPermission;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\RoleAndPermission\PermissionResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $permissions = Permission::all();
        return PermissionResource::collection($permissions);
    }

    public function store(): PermissionResource
    {
        $permission = Permission::create(request()->only('name'));
        return new PermissionResource($permission);
    }
    public function show(Permission $permission): PermissionResource
    {
        return new PermissionResource($permission);
    }
    public function update(Permission $permission): PermissionResource
    {
        $permission->update(request()->only('name'));
        return new PermissionResource($permission);
    }
    public function destroy(Permission $permission): \Illuminate\Http\JsonResponse
    {
        $permission->delete();
        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
