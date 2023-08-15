<?php

namespace Tests\Feature\Transaction;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_transaction(): void
    {
        $userData = [
            "name" => Str::random(10),
            "email" => Str::random(10). "@email.com",
            "password" => "password",
        ];

        $user = User::create($userData);

        $this->actingAs($user);

        $subscriptionData = [
            "name" => Str::random(10),
            "user_id" => $user->id,
            "renewed_at"=> Carbon::now(),
            "expired_at"=>Carbon::now()->addMonth(),
            "price" =>rand(10, 100)
        ];

        $subscription = Subscription::create($subscriptionData);

        $transactionData = [
            'subscription_id' => $subscription->id,
            'price' => $subscription->price,
        ];

        $this->json('POST', 'api/user/'.$user->id.'/transaction', $transactionData, ['Accept' => 'application/json'])
            ->assertStatus(201);
    }
}
