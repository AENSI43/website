<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\User;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testApiAuthentication()
    {
        $response = $this->getJson('/api/user');

        $response->assertStatus(401);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user, 'api')->getJson('/api/user');

        $response->assertStatus(200);
    }
}
