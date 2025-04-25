<?php

namespace App\Http\Controllers\Api\V1\Admin\Auth;

use App\Data\Auth\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Services\Auth\AdminAuthServiceInterface;

class LoginController extends Controller
{
    public function __construct(private AdminAuthServiceInterface $authService) {}

    public function __invoke(LoginRequest $request)
    {
        $data = LoginData::from($request->validated());
        $result = $this->authService->login($data);

        return response()->json([
            'message' => __('auth.login_success'),
            'data' => $result,
        ]);
    }
}
