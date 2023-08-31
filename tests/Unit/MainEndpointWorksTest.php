<?php

namespace Tests\Unit;

use Tests\TestCase;

class MainEndpointWorksTest extends TestCase
{
    /**
     * Test if the main endpoint works.
     */
    public function test_that_true_is_true(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
