<?php

use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Cupon;
use App\Models\Info;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Cookie;

    function cateogries(){
        return Category::where('parent_id',null)->with('subcategory')->orderBy('name', 'desc')->get();
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

    function total_Banner(){
        return Banner::count();
    }

    function total_cupon(){
        return Cupon::count();
    }

    function total_user_msg(){
        return Contact::count();
    }

    function total_order(){
        return Order::count();
    }
