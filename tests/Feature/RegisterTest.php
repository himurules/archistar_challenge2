<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /*
    public function testsRegistersSuccessfully()
    {
        $payload = [
            'name' => 'Example',
            'email' => 'example@test.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
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
        ;
    }
    */

    /**
     * A basic feature to validate registration.
     *
     * @return void
     */
    public function testsRequiresPasswordEmailAndName()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJsonFragment(
                [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            );
    }

    /**
     * A basic feature to check confirmation password is required.
     *
     * @return void
     */
    public function testsRequirePasswordConfirmation()
    {
        $payload = [
            'name' => 'John',
            'email' => 'john@toptal.com',
            'password' => 'toptal123',
        ];

        $this->json('post', '/api/register', $payload)
            ->assertStatus(422)
            ->assertJsonFragment(
                [
                'password' => ['The password confirmation does not match.'],
                ]
            );
    }
}
