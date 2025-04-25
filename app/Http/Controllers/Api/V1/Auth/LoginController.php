<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Actions\Auth\LoginAction;
use App\Data\Auth\LoginData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;

class LoginController extends Controller
{
    public function __construct(private LoginAction $loginAction) {}

    public function __invoke(LoginRequest $request)
    {
        $data = LoginData::from($request->validated());
        $result = $this->loginAction->execute($data);

        return response()->json([
            'message' => __('auth.login_success'),
            'data' => $result,
        ]);
    }
}
