<?php

namespace App\Http\Controllers;

use Error;
use Stripe\Charge;
use Stripe\StripeClient;
use App\Models\Subscription;
use App\Services\Payments\StripePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentsController extends Controller
{
    public function create(StripePayment $stripe, Subscription $subscription)
    {
        //check if subscription is pending before continue
        return $stripe->createCheckoutSession($subscription);
    }

    public function store(Request $request)
    {

        $subscription = Subscription::findOrFail($request->subscription_id);

        $stripe = new StripeClient(config('services.stripe.secret_key'));
        try {

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' => $subscription->price * 100,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            return [
                'clientSecret' => $paymentIntent->client_secret,
            ];
        } catch (Error $e) {
            return Response::json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function success(Request $request, Subscription $subscription)
    {
        return view('payments.success');
    }

    public function cancel(Request $request, Subscription $subscription)
    {
        return view('payments.cancel');
    }
}
