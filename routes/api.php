<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {

    // Create subscription
    Route::post('/subscriptions', [SubscriptionController::class, 'subscribe']);

    //Get my subscriptions
    Route::get('/subscriptions', [SubscriptionController::class, 'mySubscriptions']);

    //Cancel subscription
    Route::post('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);

    // Premium Feature
    Route::get('/premium', [SubscriptionController::class, 'premiumFeature']);

    // Upgrade/Downgrade
    Route::patch('/subscriptions/{id}', [SubscriptionController::class, 'update']);
});
