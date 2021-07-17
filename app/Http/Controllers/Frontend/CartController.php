<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cupon;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;
use Laravel\Ui\Presets\React;

class CartController extends Controller
{
    public function index($cupon_name = ''){
        $cupon_error = '';
        $discount_amonut = 0;

        if($cupon_name == ''){
            $cupon_name = '';
        } else{
            if(Cupon::where('name', $cupon_name)->exists()){
                if(Cupon::where('name', $cupon_name)->first()->validity >= Carbon::now()->format('Y-m-d')){
                    $subtotal = 0;
                    foreach(cart_items() as $data){
                        $subtotal += $data->products->price * $data->quantity;
                    }
                    // echo $subtotal;
                    if(Cupon::where('name', $cupon_name)->first()->purchase_amount < $subtotal){
                        $discount_amonut = Cupon::where('name', $cupon_name)->first()->discount_amonut;
                    } else{
                        $cupon_error = 'Youn have not a Discount!😞';
                    }
                } else{
                    $cupon_error = 'Your Cupon Date is Expired';
                }
            } else{
                $cupon_error = "Your Cupon  doesn't match with our Cupons!";
            }
        }

        session()->remove('discount_amonut');
        $cupons = Cupon::where('status', 'active')->whereDate('validity', '>=',Carbon::now()->format('Y-m-d'))->get();
        return view('frontend.layouts.pages.cart', compact('cupon_error', 'discount_amonut', 'cupon_name', 'cupons'));
    }


    public function store(Request $request){
        if($request->quantity >= 1){
            $generated_random_id = Str::random(6).rand();

            if(Cookie::has('c_g_number') != null){
                $generated_cart_id = Cookie::get('c_g_number');
            } else{
                $generated_cart_id = Cookie::queue('c_g_number', $generated_random_id, 1440);
            }

            if(Cart::where('g_cart_id', $generated_cart_id)->where('product_id', $request->product_id)->exists()){
                Cart::where('g_cart_id', $generated_cart_id)->where('product_id', $request->product_id)->increment('quantity', $request->quantity);
            } else{
                Cart::create([
                    'g_cart_id' => $generated_cart_id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);
            }
            session()->flash('s_status', 'Category has been Updated!');
            return back();
        } else{
            return back()->with('b_status', 'Please Quantity minimum can be 1');
        }
    }


    public function update(Request $request){
        foreach($request->quantity as $key => $quantity){
            // echo $key.' = '.$quantity.'<br>';
            if($quantity < 0){
                return back()->with('b_status', "At least add 1 Product!");
            } else{
                Cart::findOrFail($key)->update([
                    'quantity' => $quantity
                ]);
            }
        }
        session()->flash('s_status', 'Cart Item has been Updated!');
        return back();
    }


    public function destroy(Cart $id){
        $id->delete();
        return back()->with('b_status', 'One item has been Removed!');
    }
}
