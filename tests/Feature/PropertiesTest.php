<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Properties;
use Tests\TestCase;

class PropertiesTest extends TestCase
{
    /**
     * Test to check if properties are listed properly
     */
    public function testPropertiesAreListedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/properties', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' =>
                        [
                        '*' =>  [
                            'id',
                            'type',
                            'attributes'
                        ]
                    ],
                ]
            );
    }

    /**
     * Test properties are created ok
     */
    public function testPropertiesAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'suburb' => 'suburb1',
            'state' => 'state1',
            'country' => 'country1',
        ];

        $this->json('POST', '/api/properties', $payload, $headers)
            ->assertStatus(201)
            ->assertJsonStructure(
                [
                    'id',
                    'type',
                    'attributes',
                ]
            );
    }

    /**
     * Test to update a property analytic
     */
    public function testPropertyAnalyticUpsert()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'property_id' => '1',
            'analytic_type_id' => '1',
            'value' => '25',
        ];

        $this->json('POST', '/api/properties/analytic', $payload, $headers)
            ->assertStatus(200);
    }

    /**
     * Test to get all analytics of a property
     */
    public function testPropertyAnalytics()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $response = $this->json('GET', '/api/properties/1/analytics', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    'data' =>
                        [
                            '*' => [
                                'id',
                                'type',
                                'attributes'    => [
                                    'name',
                                    'units',
                                    'is_numeric',
                                    'num_decimal_places'
                                ]
                            ]
                        ],
                ]
            );
    }
}
