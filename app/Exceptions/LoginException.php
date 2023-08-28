<?php

namespace App\Exceptions;

use Exception;
use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;

class LoginException extends Exception
{
    use JsonResponse;

    /**
     * LoginException Message
     *
     * @var string
     */
    public $message = "Email or password are wrong.";

    /**
     * LoginException Status Code
     *
     * @var int
     */
    public $code = Response::HTTP_UNAUTHORIZED;

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
