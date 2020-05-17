<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test for login validation.
     *
     * @return void
     */
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJsonFragment(
                [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            );
    }

    /**
     * A test for login success.
     *
     * @return void
     */
    public function testUserLoginSuccessfully()
    {
        $payload = ['email' => 'test@example.com', 'password' => 'secret'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'name',
                        'email',
                        'created_at',
                        'updated_at',
                        'api_token',
                    ],
                ]
            );

    }
}
