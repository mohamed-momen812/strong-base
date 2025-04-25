<?php

namespace App\Actions\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\ValidationException;


class VerifyEmailAction
{
    public function execute(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            throw ValidationException::withMessages([
                'email_verified' => __('auth.email_already_verified'),
            ]);
        }

        if (! URL::hasValidSignature($request)) {
            throw ValidationException::withMessages([
                'email_verification' => __('auth.invalid_verification_link'),
            ]);
        }

        $user = User::findOrFail($request->id);

        if (! hash_equals((string) $request->hash, sha1($user->email))) {
            throw ValidationException::withMessages([
                'email_verification' => __('auth.invalid_verification_link'),
            ]);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
    }
}
