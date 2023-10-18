<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StripeWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        $payload = $request->all();

        if ($payload['type'] == 'customer.subscription.created') {
            $this->handleSubscriptionCreated($payload);
        }

        return response()->json(['received' => true]);
    }

    protected function handleSubscriptionCreated($payload)
    {
        // Extract relevant data from the payload
        $subscriptionData = $payload['data']['object'];
        $stripeSubscriptionId = $subscriptionData['id'];
        $stripeCustomerId = $subscriptionData['customer'];

        // Find the corresponding user in your database
        $user = User::where('stripe_id', $stripeCustomerId)->first();

        if ($user) {
            // Sync the subscription data from Stripe to your database
            $user->subscriptions()->updateOrCreate(
                ['stripe_id' => $stripeSubscriptionId],
                [
                    'name' => 'default',  // Update this if you have multiple subscription plans
                    'stripe_status' => $subscriptionData['status'],
                    'stripe_price' => $subscriptionData['items']['data'][0]['price']['id'],
                    // ... other subscription fields ...
                ]
            );
        }

    }
}
