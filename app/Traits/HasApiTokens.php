<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasApiTokens
{
    public function generateApiToken()
    {
        $token = Str::random(60);
        
        $this->forceFill([
            'api_token' => hash('sha256', $token),
        ])->save();

        return $token;
    }

    public function revokeApiToken()
    {
        $this->forceFill([
            'api_token' => null,
        ])->save();
    }
}