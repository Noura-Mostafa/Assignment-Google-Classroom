<?php

namespace App\Http\Controllers;

use Error;
use Stripe\Charge;
use Stripe\StripeClient;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PaymentsController extends Controller
{
    public function create(Subscription $subscription)
    {
        return view('checkout', [
            'subscription' => $subscription,
        ]);
    }

    public function store(Request $request)
    {
    
            $subscription = Subscription::findOrFail($request->subscription_id);
    
            $stripe = new StripeClient(config('services.stripe.secret_key'));
            try {
    
                $paymentIntent = $stripe->paymentIntents->create([
                    'amount' => $subscription->price*100,
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
                ] , 500);
            }
        
    }

    public function success(Request $request)
    {
        return $request->all();

        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $payment_intent = $stripe->paymentIntents->retrieve([
            $request->input('payment_intent'),
            ],
        );
    }

    public function cancel(Request $request)
    {
        return $request->all();
    }
}





// $stripe->charges->create([
//     'amount' => $subscription->price * 100 ,
//     'currency' => 'usd',
//     'source' => $subscription->id,
//     'description' => $subscription->name,
// ]); 


// \Stripe\Stripe::setApiKey(config('services.stripe.secert_key'));

// $checkout_session = Charge::create([
//     // 'line_items' => [[
//     //     # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
//     //     'price' => $subscription->price,
//     //     'quantity' => 1,
//     // ]],
//     'mode' => 'setup',
//     'client_reference_id' => $subscription->id,
//     'customer_email' => $subscription->user->email,
//     'success_url' => route('payments.success'),
//     'cancel_url' =>  route('payments.cancel'),
// ]);