<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class IndexController extends Controller
{
    public function index(){
        return view('frontend.layouts.index', [
            // 'banners' => Banner::where('status', 'active')->latest()->limit(3)->get(),
            'categories' => Category::orderBy('name', 'desc')->get(),
            'products' => Product::all(),
            'banners' => Banner::all(),
            'testimonials' => Testimonial::all(),
            // 'testimonials' => Testimonial::where('status', 'active')->latest()->limit(3)->get(),
        ]);
    }


    public function shop(){
        return view('frontend.layouts.pages.shop', [
            'categories' => Category::all(),
            'products' => Product::orderBy('id', 'desc')->paginate(20)
        ]);
    }


    public function productCategory($slug){
        return view('frontend.layouts.pages.category', [
            'categories' => Category::where('slug', $slug)->firstOrFail()
        ]);
    }


    public function productDetails($slug){
        $products = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $products->category_id)->orderBy('id', 'desc')->limit(4)->get();
        // dd($related_products);
        return view('frontend.layouts.pages.product-details', compact('products', 'related_products'));
    }


    public function about(){
        return view('frontend.layouts.pages.about');
    }


    public function contact(){
        return view('frontend.layouts.pages.contact');
    }


    public function contactStore(Request $request){
        $file_name = '';
        if(request()->hasFile('files')){
            $file = request()->file('files');
            if($file->isValid()){
                $file_name = date('Ymdhms').'.'.$file->getClientOriginalExtension();
                $file->storeAs('contact', $file_name);
            }
        }
        Contact::create($request->except('_token', 'files') + [
            'files' => $file_name,
        ]);
        session()->flash('s_status', 'We Recive Your Message!');
        return back();
    }
}
