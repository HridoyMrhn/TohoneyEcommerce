<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Country;
use App\Models\Product;
use App\Models\OrderDetail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PurcheseConfirm;
use App\Models\BillingAddress;
use App\Models\ShippingAddress;
use App\Http\Requests\CheckoutForm;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

class CheckoutController extends Controller
{
    public function index(){
        // print_r(session()->all());
        if(session('subtotal') != null){
            return view('frontend.layouts.pages.checkout',[
                'user' => User::findOrFail(Auth::id()),
                'countries' => Country::all()
                ]);
        }
        else{
            return redirect()->route('cart.index')->with('b_status', 'Pleas, at least 1 Product Add to Cart!');
        }
    }


    public function getCity(Request $request){
        // return $request->all();
        $getCities = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $data){
            $getCities .= "<option value='".$data->id."'>".$data->name."</option>";
        }
        return response()->json($getCities);
    }


    public function store(CheckoutForm $request){
        // dd($request->all());
        if($request->shipping_address_status){
            $billing_id = BillingAddress::insertGetId([
                "billing_name" => $request->billing_name,
                "billing_email" => $request->billing_email,
                "billing_number" => $request->billing_number,
                "billing_country_id" => $request->billing_country_id,
                "billing_city_id" => $request->billing_city_id,
                "billing_postal_code" => $request->billing_postal_code,
                "billing_address" => $request->billing_address,
                "billing_notes" => $request->billing_notes,
                "created_at" => Carbon::now()
            ]);
            $shipping_id = ShippingAddress::insertGetId([
                "shipping_name" => $request->shipping_name,
                "shipping_email" => $request->shipping_email,
                "shipping_number" => $request->shipping_number,
                "shipping_city_id" => $request->shipping_city_id,
                "shipping_country_id" => $request->shipping_country_id,
                "shipping_postal_code" => $request->shipping_postal_code,
                "shipping_address" => $request->shipping_address,
                "created_at" => Carbon::now()
            ]);
        } else{
            $billing_id = BillingAddress::insertGetId([
                "billing_name" => $request->billing_name,
                "billing_email" => $request->billing_email,
                "billing_number" => $request->billing_number,
                "billing_country_id" => $request->billing_country_id,
                "billing_city_id" => $request->billing_city_id,
                "billing_postal_code" => $request->billing_postal_code,
                "billing_address" => $request->billing_address,
                "billing_notes" => $request->billing_notes,
                "created_at" => Carbon::now()
            ]);
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'billing_id' => $billing_id,
            'shipping_id' => $shipping_id ?? null,
            'cupon_name' => session('cupon_name'),
            'payment_gateway' => $request->payment_gateway,
            'discount_amount' => session('discount_amonut'),
            'subtotal' => session('subtotal'),
            'total' => session('subtotal') - session('discount_amonut') + 100,
            'transaction_id' => $request->transaction_id,
            'invoice_id' => Str::random(10),
            "created_at" => Carbon::now()
        ]);

        foreach(cart_items() as $data){
            // echo $data;
            OrderDetail::create([
                "order_id" => $order_id,
                'user_id' => Auth::id(),
                "product_id" => $data->product_id,
                "product_price" => $data->products->price,
                "product_quantity" => $data->quantity,
                "created_at" => Carbon::now()
            ]);
            // Delete form Cart item
            $data->delete();

            // Product Decrement/increment
            $products = Product::find($data->product_id);
            $products->decrement('quantity', $data->quantity);
            $products->increment('best_sell', 1);
        }

        // $order_details = OrderDetail::where('order_id', $order_id)->get();
        $order_details = Order::findOrFail($order_id);
        Mail::to(Auth::user()->email)->send(new PurcheseConfirm(Auth::user()->name, $order_details));
        if($request->payment_gateway == 'Card'){
            session(['order_id' => $order_id]);
            return redirect()->route('stripe.payment');
        }
        return redirect()->route('profile')->with('s_status', "Your Ordred Succesfully!");
    }


    public function rander($id){
        $order_details = Order::findOrFail($id);
        return (new PurcheseConfirm(Auth::user()->name, $order_details))->render();
    }
}
