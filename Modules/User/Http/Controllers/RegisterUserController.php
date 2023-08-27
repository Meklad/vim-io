<?php

namespace Modules\User\Http\Controllers;

use App\Traits\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse as Response;
use Modules\User\Services\RegisterUserService;
use Modules\User\Http\Requests\CreateUserRequest;

class RegisterUserController extends Controller
{
    use JsonResponse;

    /**
     * RegisterUserController Constructor.
     */
    public function __construct(private RegisterUserService $registerService){}

    /**
     * Register New User Into The System.
     */
    public function register(CreateUserRequest $request): Response
    {
        $user = $this->registerService->registerUser($request->except("password_confirmation"));

        return $this->respond(
            success: true,
            status: 201,
            message: "Welcome {$user->name} To VimIo, You Completed The Registiration Successfully.",
        );
    }
}
