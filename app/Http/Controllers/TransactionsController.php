<?php

namespace App\Http\Controllers;

use App\Http\Requests\Transaction\TransactionRequest;
use App\Models\User;
use App\Services\TransactionService;

class TransactionsController extends Controller
{
    /**
     * @var TransactionService
     */
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    public function transaction(TransactionRequest $request, User $user)
    {

        $transaction = $this->transactionService->createTransaction($request);

        return response()->json([
            'transaction' => [
                'id' => $transaction->id,
                'user_id' => $transaction->user_id,
                'subscription_id' => $transaction->subscription_id,
                'price' => $transaction->price
            ],
        ], 201);

    }
}
