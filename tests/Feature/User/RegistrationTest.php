<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_new_users_can_register(): void
    {
        $userData = [
            "name" => "Unit Test User",
            "email" => "unittestuser@email.com",
            "password" => "password",
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
