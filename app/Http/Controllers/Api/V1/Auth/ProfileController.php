<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Auth\UserResource;
use App\Services\Auth\AuthServiceInterface;

class ProfileController extends Controller
{
    public function __construct(private AuthServiceInterface $authService) {}

    public function show()
    {
        $user = $this->authService->getUser();

        return response()->json([
            'data' => new UserResource($user),
        ]);
    }

    public function logout()
    {
        $this->authService->logout();

        return response()->json([
            'message' => __('auth.logout_success'),
        ]);
    }
}
