<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function __invoke(Request $request, StripeClient $stripe)
    {
        $endpoint_secret = 'whsec_6dbdacb286bc53a57a78a0036f5a3823eb7d6aacc6ebfbc1b4983936793f5209';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                Payment::where('gateway_reference_id', $session->id)->update([
                    'gateway_reference_id' => $session->payment_intent
                ]);
                break;
            case 'payment_intent.amount_capturable_updated':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.canceled':
                $paymentIntent = $event->data->object;
                // delete subscription
                break;
            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.partially_funded':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                break;
            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $payment = Payment::where('gateway_reference_id' , $paymentIntent->id)->first();
                $payment->forceFill([
                    'status' => 'completed'
                ])->save();

                $subscription  = Subscription::where('id' , $payment->subscription_id)->first();
                $subscription->update([
                    'status' => 'completed',
                    'expires_at' => now()->addMonths(3),
                ])->save();
                    break;
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('' , 200);
    }
}
