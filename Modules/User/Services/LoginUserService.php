<?php

namespace Modules\User\Services;

use Throwable;
use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

class LoginUserService
{
    /**
     * Handle login steps.
     */
    public function login(array $credentials): array|Throwable
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return [
                'user' => [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email,
                    "email_verified_at" => $user->email_verified_at
                ],
                'authorization' => [
                    "token" => $user->createToken(config("sanctum.api_key"))->plainTextToken,
                    "token_type" => "Bearer"
                ]
            ];
        }

        throw new LoginException;
    }
}
