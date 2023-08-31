<?php

namespace Modules\User\Services;

use Throwable;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\SentVerificationCode;
use Modules\User\Entities\AccountVerification;
use App\Exceptions\WrongVerificationCodeException;
use Modules\User\Emails\ThankYouForVerifingYourAccount;

class AccountVerificationService
{
    /**
     * Handle Sending Verification code.
     */
    public function resent(User $user): bool
    {
        if(!$user->hasVerifiedEmail()) {
            Mail::to($user->email)->send(new SentVerificationCode($user));
            return true;
        }

        return false;
    }


    /**
     * Handle Verification Step.
     */
    public function verifying(int $code): bool|Throwable
    {
        $accountVerification = AccountVerification::where("code", $code)->where("is_used", false)->first();

        if(empty($accountVerification)) {
            return true;
        }

        if(!empty($accountVerification) && auth()->user()->id != $accountVerification->user_id) {
            throw new WrongVerificationCodeException;
        }

        $accountVerification->verify();

        Mail::to(auth()->user()->email)->send(new ThankYouForVerifingYourAccount($accountVerification->user));

        return true;
    }
}
