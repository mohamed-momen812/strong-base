<?php

namespace App\Http\Resources\Api\V1\RoleAndPermission;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'permissions',
            'name' => $this->name,
        ];
    }
}
