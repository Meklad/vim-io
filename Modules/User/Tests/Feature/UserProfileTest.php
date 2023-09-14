<?php

namespace Modules\User\Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserProfileTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Test if the user can get his profile info
     *
     * @return void
     */
    public function testUserCanGetHisProfileInfo()
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

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
            "Authorization" => "{$authorization["token_type"]} {$authorization["token"]}"
        ])->getJson('api/me');

        $response->assertStatus(Response::HTTP_OK);
    }

    /**
     * Test if the user can get his profile info
     *
     * @return void
     */
    public function testUserCannotAccessWithoutAccessToken()
    {
        $user = User::factory()->create();

        $response = $this->withHeaders([
            "Accept" => "application/json",
            "Content-Type" => "application/json",
        ])->getJson('api/me');

        $response->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
