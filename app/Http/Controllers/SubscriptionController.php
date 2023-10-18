<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Cashier\Exceptions\IncompletePayment;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();  // replace with your user retrieval logic
        $paymentMethod = $request->input('payment_method_id');  // assume payment method id is sent with request

        try {
            $subscription = $user->newSubscription('default', 'price_1O0AW4C24Uo4LfTDXdjegqJw')
                ->create($paymentMethod);
            return response()->json(['success' => true, 'subscription' => $subscription]);
        } catch (IncompletePayment $exception) {
            return response()->json([
                'success' => false,
                'requires_action_url' => route(
                    'cashier.payment',
                    [$exception->payment->id, 'redirect' => route('home')]
                )
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
