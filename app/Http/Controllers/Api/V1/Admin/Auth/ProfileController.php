<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Admin\Auth\AdminResource;
use App\Services\Auth\AdminAuthServiceInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct(private AdminAuthServiceInterface $authService) {}

    public function show()
    {
        $admin = $this->authService->getUser();

        return response()->json([
            'data' => new AdminResource($admin),
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
