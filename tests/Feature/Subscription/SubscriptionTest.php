<?php

namespace Tests\Feature\Subscription;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_new_subscription_can_create(): void
    {
        $userData = [
            "name" => Str::random(10),
            "email" => Str::random(10). "@email.com",
            "password" => "password",
        ];

        $user = User::create($userData);

        $subscriptionData = [
            "name" => Str::random(10),
            "renewed_at"=> Carbon::now(),
            "expired_at"=>Carbon::now()->addMonth(),
            "price" =>rand(10, 100)
        ];

        $this->actingAs($user);

        $this->json('POST', 'api/user/'.$user->id.'/subscription', $subscriptionData, ['Accept' => 'application/json'])
            ->assertStatus(201);

    }

    public function test_update_subscription(): void
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

        $subscriptionNewData =
        [
            "name" => Str::random(10),
        ];
        $this->json('PUT', 'api/user/'.$user->id. '/subscription' .'/'. $subscription->id, $subscriptionNewData, ['Accept' => 'application/json'])
            ->assertStatus(201);

    }

    public function test_delete_subscription(): void
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

        $subscriptionNewData =
        [
            "name" => Str::random(10),
        ];
        $this->json('DELETE', 'api/user/'.$user->id. '/subscription' .'/'. $subscription->id)
            ->assertNoContent();
    }
}
