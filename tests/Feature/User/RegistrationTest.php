<?php

namespace Tests\Feature\User;

use Tests\TestCase;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_new_users_can_register(): void
    {
        $userData = [
            "name" => Str::random(10),
            "email" => Str::random(10)."@email.com",
            "password" => "password",
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
