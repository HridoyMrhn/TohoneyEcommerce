<?php

namespace App\Http\Controllers\Frontend;

use Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    public function stripe()
    {
        if(session('order_id') != null){
            return view('frontend.layouts.pages.payment-stripe');
        }
        return redirect()->route('shop')->with('b_status', 'Pleas, at least 1 Product Add to Cart!');
    }


    public function stripePost(Request $request)
    {
        // print_r(session()->all());
        // die();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => session('subtotal') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Payment from Tohoney.com! for Order ID #".session('order_id')
        ]);
        Session::flash('s_status', 'Payment Successful!');

        // For Payment Status Update
        Order::find(session('order_id'))->update([
            'payment_status' => 'Paid'
        ]);

        // For All Session Null
        session([
            'subtotal' => '',
            'cupon_name' => '',
            'order_id' => '',
        ]);
        return redirect()->route('profile');
    }
}
