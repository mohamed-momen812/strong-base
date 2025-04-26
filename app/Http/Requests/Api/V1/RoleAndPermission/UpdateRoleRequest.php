<?php

namespace App\Http\Requests\Api\V1\RoleAndPermission;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255', 'unique:roles,name,' . $this->route('role')->id],
            'guard_name' => ['required', 'string', 'max:255' , 'in:api,admin'],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => ['string', 'exists:permissions,name'],
        ];
    }


}
