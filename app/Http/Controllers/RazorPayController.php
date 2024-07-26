<?php

namespace App\Http\Controllers;

use App\Models\RazorPay;
use App\Models\Event;
use App\Models\Payment;
use App\Models\audience as Audience;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;


class RazorPayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $audience_id = $request->audience_id;
        $audience = Audience::find($audience_id);
        $event_id = $request->event_id;
        $event = Event::find($event_id);
        $amount = $event->price ?? 10;
        $currency = 'INR';
        return view('web.payments.razorpay', compact('audience_id', 'event_id', 'amount', 'currency', 'audience'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * github razorpay api link - https://github.com/razorpay/razorpay-php/blob/master/documents/order.md
     * test numbers - https://razorpay.com/docs/payments/payments/test-card-details/
     */
    public function store(Request $request)
    {
        // Initialize the Razorpay API
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {
            // Fetch payment details from Razorpay
            $payment = $api->payment->fetch($request->razorpay_payment_id);
            $paymentArray = $payment->toArray();
            $receipt_number = 'KNSA' . rand(1000, 9999);
            $payment_method = $paymentArray['method'];
            $payment_detail = $paymentArray[$payment_method];
            $payment_status = 'pending';
            $amount = $paymentArray['method'] == 'upi' ? $paymentArray['amount'] : $paymentArray['fee'] * 100;

            Log::info('Payment Response: ' . json_encode($paymentArray));

            // Capture payment if authorized
            if ($payment['status'] == 'authorized') {
                Log::info('Attempting to capture payment with amount: ' . $amount / 100);
                $response = $payment->capture(['amount' => $amount]);
                Log::info('Capture Response: ' . json_encode($response->toArray()));
                $responseArray = $response->toArray();

                if (!empty($response)) {
                    $payment_status = $responseArray['status'] == 'captured' ? 'paid' : 'pending';

                    // Create Razorpay order
                    $order = $api->order->create([
                        'receipt' => $receipt_number,
                        'amount' => $payment->amount,
                        'currency' => $payment->currency,
                    ]);
                } else {
                    Log::error('Payment capture failed: No response from Razorpay');
                }
            }

            // Save Razorpay payment info
            $razorpay = new RazorPay();
            $razorpay->razorpay_order_id = $responseArray['id'] ?? null;
            $razorpay->razorpay_payment_id = $request->razorpay_payment_id;
            $razorpay->amount = $amount / 100;
            $razorpay->currency = $payment->currency;
            $razorpay->status = $responseArray['status'] ?? $payment_status;
            $razorpay->payment_method = $payment_method;
            $razorpay->payment_detail = $payment_detail;
            $razorpay->save();

            // Save payment details
            $paymentRecord = new Payment();
            $paymentRecord->audience_id = $request->audience_id;
            $paymentRecord->event_id = $request->event_id;
            $paymentRecord->payment_method = $payment_method;
            $paymentRecord->payment_date = now();
            $paymentRecord->receipt_number = $receipt_number;
            $paymentRecord->status = $razorpay->status;
            $paymentRecord->amount = $razorpay->amount;
            $paymentRecord->payment_id = $razorpay->id;
            $paymentRecord->payment_gatway = 'razorpay';
            $paymentRecord->payment_data = $payment_detail;
            $paymentRecord->save();

            // Update audience payment status
            $audience = Audience::find($request->audience_id);
            $audience->payment_status = $payment_status;
            $audience->save();

            return redirect()->back();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(RazorPay $razorPay)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RazorPay $razorPay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RazorPay $razorPay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RazorPay $razorPay)
    {
        //
    }


    /**
     * With core API without razorpay sdk
     * Create order
     * refrence - https://razorpay.com/docs/api/orders/create/
     * https://razorpay.com/docs/payments/orders/apis/
     */
    public function createOrder()
    {
        $client = new Client();
        $url = 'https://api.razorpay.com/v1/orders';

        $data = [
            'amount' => 10000,
            'currency' => 'INR',
            'receipt' => 'receipt#1',
            'notes' => [
                'key1' => 'value3',
                'key2' => 'value2'
            ]
        ];

        try {
            $response = $client->post($url, [
                'auth' => [getenv("RAZORPAY_KEY"), getenv("RAZORPAY_SECRET")],
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => $data,
            ]);

            $responseBody = json_decode($response->getBody(), true);

            return response()->json([
                'success' => true,
                'data' => $responseBody
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Webhook
     */
    // public function handleRazorpayWebhook(Request $request)
    // {
    //     Log::info('Webhook entry');
    //     Log::info($request->all());
    //     $secret = env('RAZORPAY_WEBHOOK_SECRET');
    //     $webhookSignature = $request->header('X-Razorpay-Signature');
    //     $payload = $request->getContent();
    //     $expectedSignature = hash_hmac('sha256', $payload, $secret);

    //     if ($webhookSignature !== $expectedSignature) {
    //         //return response()->json(['status' => 'signature mismatch'], 400);
    //         Log::info('signature mismatch');
    //     }

    //     // Process the webhook payload
    //     $event = $request->event;
    //     switch ($event) {
    //         case 'payment.authorized':
    //             // Handle payment authorized event
    //             Log::info('payment authorized');

    //             break;
    //         case 'payment.captured':
    //             // Handle payment captured event
    //             Log::info('payment captured');

    //             break;
    //         case 'payment.failed':
    //             // Handle payment failed event
    //             Log::info('payment failed');

    //             break;
    //             // Add other cases as needed
    //     }

    //     Log::info('Webhook received');

    //     // return response()->json(['status' => 'success'], 200);
    // }

    public function handleRazorpayWebhook(Request $request)
    {
        Log::info($request->all());
        Log::info('Razorpay webhook is working');
        $webhookSecret = env('RAZORPAY_WEBHOOK_SECRET');
        $payload = $request->getContent();
        $signature = $request->header('X-Razorpay-Signature');

        try {
            $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
            $response = $api->utility->verifyWebhookSignature($payload, $signature, $webhookSecret);

            // // Process the webhook payload here
            // Log::info('Webhook verified and payload:', $request->all());

            Log::info($response->toArray());

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            Log::error('Webhook verification failed:', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'failed'], 400);
        }
    }
}
