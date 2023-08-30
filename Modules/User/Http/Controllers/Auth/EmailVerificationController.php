<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Traits\JsonResponse;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\SentVerificationCode;
use Modules\User\Http\Requests\VerifyAccountRequest;
use Modules\User\Services\AccountVerificationService;

class EmailVerificationController extends Controller
{
    use JsonResponse;

    /**
     * EmailVerificationController Constructor.
     */
    public function __construct(public AccountVerificationService $verificationService)
    {
        $this->middleware("auth:sanctum");
    }

    /**
     * Resent email with Verification code.
     */
    public function resentVerification(Request $request): Response
    {
        if($this->verificationService->resent($request->user())) {
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

    /**
     * Verifiy user account.
     */
    public function verifying(VerifyAccountRequest $request): Response
    {
        $this->verificationService->verifying($request->get("code"));

        return $this->respond(
            success: true,
            status: Response::HTTP_OK,
            message: "Your Account Has Been Verified."
        );
    }
}
