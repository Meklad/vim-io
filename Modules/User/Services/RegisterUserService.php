<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\UserRegisted;

class RegisterUserService
{
    /**
     * Register new user to the system, and do other suff
     */
    public function registerUser(array $payload): User
    {
        $user = $this->createNewUser($payload);
        $this->createVerification($user);
        $this->sentWelcomeMail($user);
        return $user;
    }

    /**
     * Create new user into the database, than return it.
     */
    public function createNewUser(array $payload): User
    {
        return User::create([
            'name' => $payload["name"],
            'email' => $payload["email"],
            'password' => bcrypt($payload["password"])
        ]);
    }

    /**
     * Generate verification code.
     */
    public function createVerification(User $user): void
    {
        $user->accountVerification()->create([
            "code" => rand(1000, 9999)
        ]);
    }

    /**
     * Sent new welcome mail to the user after registration.
     */
    public function sentWelcomeMail(User $user): void
    {
        Mail::to($user->email)->send(new UserRegisted($user));
    }
}
