<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\Transactions;
use App\Repositories\SubscriptionRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class TransactionService
{
    /**
     * @var SubscriptionRepository
     */
    private $subscriptionRepository;

    public function __construct(SubscriptionRepository $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }
    public function createTransaction(Request $request)
    {
        $user = $request->user();

        $subscription = $this->subscriptionRepository->getSubscriptionWithId($request->subscription_id);

        try {
            $transaction = Transactions::create([
                'user_id' => $user->id,
                'subscription_id' => $subscription->id,
                'price' => $request->price ? $request->price : $subscription->price,
            ]);
        } catch(Exception $e) {
            \Log::error('Transaction Create Error');
            \Log::error($e);
            abort(400, 'Transaction Create Failed');
        }

        return $transaction;
    }

}
