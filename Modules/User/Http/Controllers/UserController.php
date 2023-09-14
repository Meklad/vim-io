<?php

namespace Modules\User\Http\Controllers;

use App\Traits\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse as Response;
use Illuminate\Routing\Controller;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    use JsonResponse;

    /**
     * UserController Constructor.
     */
    public function __construct(public UserService $userService)
    {
        $this->middleware("auth:sanctum");
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(): Response
    {
        return $this->respond(
            success: true,
            status: Response::HTTP_OK,
            message: "successfuly retrive user info",
            data: $this->userService->userInfo()
        );
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return response()->json([
            "success" => true,
            "status" => 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function updatePassword(Request $request, $id)
    {
        return response()->json([
            "success" => true,
            "status" => 200
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        return response()->json([
            "success" => true,
            "status" => 200
        ]);
    }
}
