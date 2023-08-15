<?php

namespace App\Http\Controllers\Subscription;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\StoreSubscriptionRequest;
use App\Http\Requests\Subscription\UpdateSubscriptionRequest;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * @var SubscriptionService
     */
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function storeSubscription(StoreSubscriptionRequest $request, User $user)
    {

        $subscription = $this->subscriptionService->createSubscription($request);

        return response()->json([
            'subscription' => [
                'name' => $subscription->name,
                'renewed_at' => $subscription->renewed_at,
                'expired_at' => $subscription->expired_at,
            ],
        ], 201);

    }

    public function updateSubscription(UpdateSubscriptionRequest $request, User $user, Subscription $subscription)
    {
        $subscription = $this->subscriptionService->updateSubscription($request, $subscription);

        return response()->json([
            'subscription' => [
                'name' => $subscription->name,
                'renewed_at' => $subscription->renewed_at,
                'expired_at' => $subscription->expired_at,
            ],
        ], 201);

    }

    public function deleteSubscription(User $user, Subscription $subscription)
    {
        $this->subscriptionService->deleteSubscription($subscription);

        return response()->noContent();
    }

}
