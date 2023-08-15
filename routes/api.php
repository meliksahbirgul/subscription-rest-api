<?php

use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\Transaction\TransactionsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [UserController::class,'login']);
Route::post('/register', [UserController::class,'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::post('/{user}/subscription', [SubscriptionController::class,'storeSubscription']);
        Route::put('/{user}/subscription/{subscription}', [SubscriptionController::class,'updateSubscription']);
        Route::delete('/{user}/subscription/{subscription}', [SubscriptionController::class,'deleteSubscription']);
        Route::post('/{user}/transaction', [TransactionsController::class,'transaction']);
        Route::get('/{user}', [UserController::class,'me']);
    });
});
