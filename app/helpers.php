<?php

use App\Models\Cart;
use App\Models\Cupon;
use App\Models\Order;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Newsletter;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

    // function cateogries(){
    //     return Category::where('parent_id',null)->with('subcategory')->orderBy('name', 'desc')->get();
    // }
    function cateogries(){
        return Category::with('subcategory')->orderBy('name', 'desc')->get();
    }

    function total_cart_item(){
        return Cart::where('g_cart_id', Cookie::get('c_g_number'))->count();
    }

    function cart_items(){
        return Cart::where('g_cart_id', Cookie::get('c_g_number'))->get();
    }

    function title(){
        return $title = 'Tohoney Ecommerce - Laravel';
    }

    /**
     * ======= All Total
     */
    function total_categories(){
        return Category::count();
    }

    function total_products(){
        return Product::count();
    }

    function alert_products(){
        $alert_products = DB::table('products')->whereColumn('quantity_alert', '>=', 'quantity')->count();
        return $alert_products;
    }

    function total_Banner(){
        return Banner::count();
    }

    function total_cupon(){
        return Cupon::count();
    }

    function total_user_msg(){
        return Contact::count();
    }

    function total_orders(){
        return Order::count();
    }

    function total_pending_orders(){
        return Order::where('status', 'pending')->count();
    }

    function total_accept_orders(){
        return Order::where('status', 'accept')->count();
    }

    function total_cancel_orders(){
        return Order::where('status', 'cancel')->count();
    }

    function total_sale_amount(){
        $total_sale_amount = 0;
        foreach(Order::pluck('total') as $data){
            $total_sale_amount += $data;
        }
        return $total_sale_amount;
    }

    function total_review($product_id){
        return OrderDetail::where('product_id', $product_id)->whereNotNull('rating')->count();
    }

    function total_rating($product_id){
        $count_rating = OrderDetail::where('product_id', $product_id)->whereNotNull('rating')->count();
        $total_rating = OrderDetail::where('product_id', $product_id)->whereNotNull('rating')->sum('rating');
        if($total_rating == 0){
            return 0;
        }
        return round($total_rating/$count_rating);
    }

    function total_newsletter(){
        return Newsletter::count();
    }

    function total_contacts(){
        return Contact::count();
    }
