<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Subscription;

class SubscriptionRepository
{
    public function getAllSubscriptions()
    {
        $subscriptionList = Subscription::all()->toArray();
        return $subscriptionList;
    }

    public function getSubscriptionWithId($subscriptionId)
    {
        $subscription = Subscription::find($subscriptionId);

        return $subscription ? $subscription : abort('404', 'Subscription Not Found');
    }

}
