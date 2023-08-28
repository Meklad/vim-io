<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\SentVerificationCode;

class EmailVerificationController extends Controller
{
    use JsonResponse;

    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function resentVerification(Request $request)
    {
        if(!$request->user()->hasVerifiedEmail()) {
            Mail::to($request->user()->email)->send(new SentVerificationCode($request->user()));

            return $this->respond(
                success: true,
                status: Response::HTTP_OK,
                message: "The verification code sent succsussfully."
            );
        }

        return $this->respond(
            success: true,
            status: Response::HTTP_OK,
            message: "This Account Has Been Verified."
        );
    }

    public function verifying(Request $request)
    {
        dd("verifying");
    }
}
