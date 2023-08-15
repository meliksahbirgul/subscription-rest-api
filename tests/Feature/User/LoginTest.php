<?php

namespace Tests\Feature\User;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function test_a_user_can_login_with_mail_and_password(): void
    {
        $this->post('/login', [
            'email' => 'testemail@email.com',
            'password' => 'password'
        ]);

        $this->assertGuest();

    }
}
