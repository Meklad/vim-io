<?php

namespace Modules\User\Services;

use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\SentVerificationCode;

class AccountVerificationService
{
    /**
     * Handle Verification Steps.
     */
    public function resent(User $user): void
    {
        if(!$user->hasVerifiedEmail()) {
            Mail::to($user->email)->send(new SentVerificationCode($user));
        }
    }
}
