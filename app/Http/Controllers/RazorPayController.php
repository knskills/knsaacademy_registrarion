<?php

namespace App\Http\Controllers;

use App\Models\RazorPay;
use App\Models\Event;
use App\Models\Payment;

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
        Log::info($request->all());
        $audience_id = $request->audience_id;
        $event_id = $request->event_id;
        $event = Event::find($event_id);
        Log::info($event);
        $amount = $event->price ?? 10;
        $currency = 'INR';
        return view('web.payments.razorpay', compact('audience_id', 'event_id', 'amount', 'currency'));
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
        Log::info($request->all());
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($request->razorpay_payment_id);
        $paymentArray = $payment->toArray();
        $receipt_number = 'KNSA' . rand(1000, 9999);
        $payment_method = $paymentArray['method'];
        $payment_detail = $paymentArray[$payment_method];
        Log::info($paymentArray);

        try {
            $response = $api->order->create(
                [
                    'receipt' => $receipt_number,
                    'amount' => $payment->amount,
                    'currency' => $payment->currency,
                    // 'notes' => [
                    //     'key1' => 'value3',
                    //     'key2' => 'value2'
                    // ]
                ]
            );

            // Convert the response to an array
            $responseArray = $response->toArray();
            Log::info($responseArray);

            $amount = $responseArray['amount'] / 100;

            // save rozarpay info
            $razorpay = new RazorPay();
            $razorpay->razorpay_order_id = $responseArray['id'];
            $razorpay->razorpay_payment_id = $request->razorpay_payment_id;
            $razorpay->amount = $amount;
            $razorpay->currency = $payment->currency;
            $razorpay->status = $responseArray['status'];
            $payment->payment_method = $payment_method;
            $payment->payment_detail = $payment_detail;
            $razorpay->save();

            // save payment details
            $payment = new Payment();
            $payment->audience_id = $request->audiance_id;
            $payment->event_id = $request->event_id;
            $payment->payment_method = $payment_method;
            $payment->payment_date = now();
            $payment->receipt_number = $receipt_number;
            $payment->status = $razorpay->status;
            $payment->amount = $razorpay->amount;
            $payment->payment_id = $razorpay->id;
            $payment->payment_gatway = 'razorpay';
            $payment->payment_data = $payment_detail;
            $payment->save();

            return response()->json([
                'success' => true,
                'data' => $responseArray
            ], 200);
        } catch (\Exception $e) {
            return  $e->getMessage();
            \Session::put('error', $e->getMessage());
            return redirect()->back();
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
}
