<?php

namespace App\Exceptions;

use Exception;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;

class WrongVerificationCodeException extends Exception
{
    use JsonResponse;

    /**
     * LoginException Message
     *
     * @var string
     */
    public $message = "Wrong Verification Code.";

    /**
     * LoginException Status Code
     *
     * @var int
     */
    public $code = Response::HTTP_FORBIDDEN;

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return $this->respond(
            success: false,
            status: $this->code,
            message: $this->message
        );
    }
}
