<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Subscription;
use App\Models\Invoice;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    private $serverKey;
    private $isProduction;
    private $isSanitized;
    private $is3ds;

    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = false;
        $this->isSanitized = true;
        $this->is3ds = true;

        $this->configureMidtrans();
    }

    private function configureMidtrans()
    {
        \Midtrans\Config::$serverKey = $this->serverKey;
        \Midtrans\Config::$isProduction = $this->isProduction;
        \Midtrans\Config::$isSanitized = $this->isSanitized;
        \Midtrans\Config::$is3ds = $this->is3ds;
    }

    public function subscribe(Request $request)
    {
        $isAnyTransactionActive = Subscription::where('user_id', 1)->where('payment_status_id', 1)->first();

        if ($isAnyTransactionActive != null) {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                'Content-Type' => 'application/json',
            ])->get('https://api.sandbox.midtrans.com/v2/INV-20231205-TRX-6301/status');

            return response([
                'midtrans_response' => $response->json(),
                'subcription' => $isAnyTransactionActive,
            ], 201);
        } else {
            $order_id = 'INV-' . Carbon::now()->format('YmdHis') . '-TRX-' . uniqid();

            $params = [
                'transaction_details' => [
                    'order_id' => $order_id,
                    'gross_amount' => 50000,
                ],
                'payment_type' => 'bank_transfer',
                'bank_transfer' => [
                    'bank' => 'bca',
                ],
            ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $subscription = Subscription::create([
                'user_id' => 1,
                'subscription_plan_id' => 1,
                'midtrans_token' => $snapToken,
                'order_id' => $order_id,
                'payment_status_id' => 1,
                'invoice_id' => null,
            ]);

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode(config('midtrans.server_key') . ':'),
                'Content-Type' => 'application/json',
            ])->post('https://api.sandbox.midtrans.com/v2/charge', $params);

            return response([
                'midtrans_response' => $response->json(),
                'subscription' => $subscription
            ], 201);
        }
    }

    public function callback(Request $request)
    {
        $subcribe_data = $request->all();

        $subcribe_data['user_id'] = $request->id;
        $subcribe_data['subscription_plan_id'] = $request->id;
        $subcribe_data['start_subscription'] = $request->id;
        $subcribe_data['end_subscription'] = $request->id;
        $subcribe_data['status'] = $request->id;

        $subscription_plan = SubscriptionPlan::create($subcribe_data);
    }
}
