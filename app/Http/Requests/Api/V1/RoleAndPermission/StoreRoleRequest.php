<?php

namespace App\Http\Requests\Api\V1\RoleAndPermission;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'guard_name' => ['required', 'string', 'max:255' , 'in:api,admin'],
            'permissions' => ['sometimes', 'array'],
            'permissions*' => ['string', 'exists:permissions,name'],
        ];
    }

    // public function messages(): array
    // {
    //     return [
    //         'name.required' => 'The name field is required.',
    //         'name.string' => 'The name field must be a string.',
    //         'name.max' => 'The name field may not be greater than 255 characters.',
    //         'name.unique' => 'The name has already been taken.',
    //         'permissions.array' => 'The permissions field must be an array.',
    //         'permissions.*.string' => 'Each permission must be a string.',
    //         'permissions.*.exists' => 'The selected permission is invalid.',
    //     ];
    // }
}
