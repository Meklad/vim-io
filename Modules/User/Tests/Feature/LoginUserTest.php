<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginUserTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test If login user api return 200.
     *
     * @return void
     */
    public function testUserLoginApiRetunSuccessStatusCode()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/login', [
            "email" => $user->email,
            "password" => "password",
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test If login user api return access token.
     *
     * @return void
     */
    public function testUserLoginApiReturnAccessTokenInSuccess()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/login', [
            "email" => $user->email,
            "password" => "password",
        ]);

        $authorization = $response->json()["data"]["authorization"];

        $this->assertArrayHasKey("token", $authorization);
    }

    /**
     * Test If login user api fail if all required fields are missing.
     *
     * @return void
     */
    public function testUserLoginApiFailWhenAllRequiredFieldsAreMissing()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/login');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test If login user api fail if on ro two of the required fields are missing.
     *
     * @return void
     */
    public function testUserLoginApiFailWhenSomeOfRequiredFieldsAreMissing()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/login', [
            "email" => "test@test.test"
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test If login user api throw LoginException if auth fail (wrong emai or password).
     *
     * @return void
     */
    public function testUserLoginApiThrowLoginExceptionIfAuthFail()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/login', [
            "email" => $user->email,
            "password" => "wrong password",
        ]);

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
