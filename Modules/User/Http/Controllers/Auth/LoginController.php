<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Traits\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\User\Services\LoginUserService;
use Modules\User\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse as Response;

class LoginController extends Controller
{
    use JsonResponse;

    /**
     * LoginController Constructor.
     */
    public function __construct(private LoginUserService $loginService){}

    /**
     * Log user in to the system.
     */
    public function login(LoginRequest $request): Response
    {
        $data = $this->loginService->login($request->only("email", "password"));

        return $this->respond(
            success: true,
            status: Response::HTTP_OK,
            message: "You Logged In Successfully.",
            data: $data
        );
    }
}
