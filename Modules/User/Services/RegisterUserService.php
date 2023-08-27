<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\UserRegisted;

class RegisterUserService
{
    /**
     * Register new user to the system, and do other suff
     *
     * @param array $payload
     * @return User
     */
    public function registerUser(array $payload): User
    {
        $user = User::create([
            'name' => $payload["name"],
            'email' => $payload["email"],
            'password' => bcrypt($payload["password"])
        ]);

        Mail::to($user->email)->send(new UserRegisted($user));

        return $user;
    }
}
