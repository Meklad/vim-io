<?php

namespace Modules\User\Services;

use Throwable;
use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * Get User Info.
     */
    public function userInfo(): array
    {
        return [
            "id" => auth()->user()->id,
            "name" => auth()->user()->name,
            "email" => auth()->user()->email,
            "email_verified_at" => auth()->user()->email_verified_at
        ];
    }
}
