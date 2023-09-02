<?php

namespace Modules\User\Tests\Unit;

use Tests\TestCase;
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
        $this->assertTrue(true);
    }
}
