<?php

use App\Http\Controllers\Subscription\SubscriptionController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
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

Route::group(['middleware' => ['auth:sanctum']], function ($route) {
    $route->post('/user/{user}/subscription', [SubscriptionController::class,'storeSubscription']);
    $route->put('/user/{user}/subscription/{subscription}', [SubscriptionController::class,'updateSubscription']);
    $route->delete('/user/{user}/subscription/{subscription}', [SubscriptionController::class,'deleteSubscription']);
    $route->post('/user/{user}/transaction', [TransactionsController::class,'transaction']);
    $route->get('user/{user}', [UserController::class,'me']);
});
