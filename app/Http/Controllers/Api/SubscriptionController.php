<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Plan;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $now = Carbon::now();

        $request->validate([
            'plan_id' => 'required|exists:plans,id'
        ]);

        $existing = Subscription::where('user_id', $user->id)
        ->where('status', 'active')
        ->where('expires_at', '>', now())
        ->first();

        if ($existing) {
            return response()->json([
                'message' => 'User already has an active subscription'
            ], 409);
        }

        $plan = Plan::findOrFail($request->plan_id);

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'status' => 'active',
            'expires_at' => $now->addMonth()
        ]);

        Invoice::create([
            'user_id' => $user->id,
            'subscription_id' => $subscription->id,
            'amount' => $plan->price,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Subscribed successfully',
            'subscription' => $subscription->load('plan')
        ]);
    }

    public function mySubscriptions(Request $request)
    {
        return response()->json(
            $request->user()->subscriptions()->with('plan')->get()
        );
    }

    public function cancel(Request $request, $id)
    {
        $subscription = Subscription::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $subscription->update([
            'status' => 'cancelled'
        ]);

        return response()->json([
            'message' => 'Subscription cancelled'
        ]);
    }

    public function premiumFeature(Request $request)
    {
        $subscription = $request->user()
            ->subscriptions()
            ->whereIn('status', ['active', 'cancelled'])
            ->where('expires_at', '>', now())
            ->first();

        if (!$subscription) {
            return response()->json([
                'message' => 'No active subscription'
            ], 403);
        }

        return response()->json([
            'message' => 'Welcome to premium feature 🚀'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id'
        ]);

        $subscription = Subscription::where('id', $id)
            ->where('user_id', $request->user()->id)
            ->firstOrFail();

        $plan = Plan::findOrFail($request->plan_id);

        $subscription->update([
            'plan_id' => $plan->id,
            'expires_at' => now()->addMonth()
        ]);

        return response()->json([
            'message' => 'Plan updated successfully',
            'subscription' => $subscription->load('plan')
        ]);
    }
}
