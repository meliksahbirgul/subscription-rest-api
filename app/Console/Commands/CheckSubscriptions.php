<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Models\Transactions;
use App\Services\TransactionService;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;

class CheckSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscriptions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Renew expired subscriptions by checking subscriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        \Log::info('now: ' .Carbon::now());
        $subscriptions = Subscription::where('expired_at', '<=', Carbon::now())->get();

        foreach($subscriptions as $subscription) {

            try {
                Transactions::create([
                    'user_id' => $subscription->user_id,
                    'subscription_id' => $subscription->id,
                    'price' => $subscription->price,
                ]);
            } catch(Exception $e) {
                \Log::error('Transaction Create Error');
                \Log::error($e);
            }

            $subscription->renewed_at = Carbon::now();
            $subscription->expired_at = Carbon::now()->addMonth();
            $subscription->save();
        }

    }
}
