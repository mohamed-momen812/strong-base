<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function __construct(private AuthServiceInterface $authService) {}

    public function sendVerificationEmail(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified']);
        }

        $this->authService->sendEmailVerification($user);

        return response()->json(['message' => 'Verification link sent']);
    }

    public function verify(Request $request): JsonResponse
    {
        $this->authService->verifyEmail($request);

        return response()->json(['message' => 'Email has been verified']);
    }
}
