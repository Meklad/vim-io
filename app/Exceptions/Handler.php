<?php

namespace App\Exceptions;

use Throwable;
use App\Traits\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use JsonResponse;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function(Throwable $e) {
            if(request()->wantsJson()) {
                if($e instanceof NotFoundHttpException) {
                    return $this->respond(
                        success: false,
                        status: Response::HTTP_NOT_FOUND,
                        message: $e->getMessage()
                    );
                }
            }
        });
    }
}
