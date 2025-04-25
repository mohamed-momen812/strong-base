<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\ForgotPasswordAction;
use App\Data\Auth\ForgotPasswordData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\ForgotPasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __construct(private ForgotPasswordAction $forgotPasswordAction) {}

    public function __invoke(ForgotPasswordRequest $request): JsonResponse
    {
        $data = ForgotPasswordData::from($request->validated());
        $status = $this->forgotPasswordAction->execute($data->email);

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => __($status)])
            : response()->json(['message' => __($status)], 422);
    }
}
