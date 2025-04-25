<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\RegisterAction;
use App\Data\Auth\RegisterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\Auth\UserResource;

class RegisterController extends Controller
{
    public function __construct(private RegisterAction $registerAction) {}

    public function __invoke(RegisterRequest $request)
    {
        $data = RegisterData::from($request->validated());
        $user = $this->registerAction->execute($data);

        return response()->json([
            'message' => __('auth.register_success'),
            'data' => new UserResource($user),
        ], 201);
    }
}
