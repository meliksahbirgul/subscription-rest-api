<?php

namespace App\Services;

use App\Models\Subscription;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SubscriptionService
{
    public function createSubscription(Request $request)
    {
        $user = $request->user();

        try {
            $subscription = Subscription::create([
                'name' => $request->name,
                'user_id' => $user->id,
                'price' => $request->price,
                'renewed_at' => Carbon::parse($request->renewed_at)->utc(),
                'expired_at' => Carbon::parse($request->expired_at)->utc(),
            ]);
        } catch(Exception $e) {
            \Log::error('Subscription Create Error');
            \Log::error($e);
            abort(400, 'Subscription Create Failed');
        }

        return $subscription;
    }

    public function updateSubscription(Request $request, Subscription $subscription)
    {
        try {
            $subscription->update($request->validated());
        } catch(Exception $e) {
            \Log::error('Subscription Update Error');
            \Log::error($e);
            abort(400, 'Subscription Update Failed');
        }

        return $subscription;

    }

    public function deleteSubscription(Subscription $subscription)
    {
        try {
            $subscription->delete();
        } catch(Exception $e) {
            \Log::error('Subscription delete Error');
            \Log::error($e);
            abort(400, 'Subscription Delete Failed');
        }
    }

}
