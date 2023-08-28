<?php

namespace Modules\User\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Modules\User\Entities\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentVerificationCode extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(Private User $user){}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Verification Email")
                    ->view("user::emails.verification")->with([
                        "name" => $this->user->name,
                        "code" => $this->user->accountVerification->code
                    ]);
    }
}
