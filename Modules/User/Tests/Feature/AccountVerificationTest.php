<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountVerificationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if unauthenticated user cannot call resent | verify api [api/verify] [STATUS 401]
     *
     * @return void
     */
    public function testUnAuthenticatedUserCannotCallResentVerificationCodeApi()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/verify');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test if authenticated user call resent | verify api [api/verify] and return success [STATUS 200]
     *
     * @return void
     */
    public function testAuthUserCanResendVerificationCode()
    {
        Sanctum::actingAs(User::factory()->create());
        $this->json('post', 'api/verify', [], [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->assertStatus(Response::HTTP_OK);
    }


    /**
     * Test if authenticated user verify his account using verification code.
     *
     * @return void
     */
    public function testAuthUserCanVerifyHisAccountUsingVerificationCode()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->json('post', 'api/verifying', [
            "code" => $user->generateVerificationCode()
        ], [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test if api/verifying fail if the authenticated user not send the verification code.
     *
     * @return void
     */
    public function testAuthUserNotSentVerificationCode()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->json('post', 'api/verifying', [], [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test if authenticated user send wrong verification code or send code assossiated to other user.
     *
     * @return void
     */
    public function testAuthUserSendWrongVerificationCode()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $this->json('post', 'api/verifying', [
            "code" => 3652 // wrong code...
        ], [
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
