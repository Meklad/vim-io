<?php

namespace Modules\User\Tests\Feature;

use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test if user can create new account usint api/register and return success.
     *
     * @return void
     */
    public function testUserCanCreateNewAccount()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/register', [
            "name" => $this->faker()->name(),
            "email" => $this->faker()->email(),
            "password" => $password = $this->faker()->password(6,6),
            "password_confirmation" => $password
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
    }

    /**
     * Test if user api/register return 422 status code when all required fileds are missing.
     *
     * @return void
     */
    public function testUserFailWhenAllFieldsAreRequired()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/register');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Test if api/register return 422 if one or more of the required fields are missing.
     *
     * @return void
     */
    public function testUserFailWhenOneOrMoreFieldsAreRequired()
    {
        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->postJson('api/register', [
            "name" => $this->faker()->name(),
            "email" => $this->faker()->email()
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
