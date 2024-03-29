<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Faq;
use App\Models\Banner;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ContactForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\NewsletterForm;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class IndexController extends Controller
{
    public function index(){
        $generated_random_id = Str::random(6).rand();
        Cookie::queue('c_g_number', $generated_random_id, 1440);

        return view('frontend.layouts.index', [
            'banners' => Banner::where('status', 'active')->latest()->limit(3)->get(),
            'categories' => Category::orderBy('name', 'desc')->get(),
            'products' => Product::orderBy('id', 'desc')->paginate(20),
            'best_products' => Product::where('best_sell', '>', 0)->limit(8)->get(),
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


    public function about(){
        return view('frontend.layouts.pages.about');
    }


    public function contact(){
        return view('frontend.layouts.pages.contact');
    }


    public function productCategory($slug){
        $categories = Category::where('slug', $slug)->firstOrFail();
        $catProducts = Product::where('category_id', $categories->id)->paginate(1);
        // dd($catProducts);
        return view('frontend.layouts.pages.category', compact('catProducts', 'categories'));
    }


    public function productDetails($slug){
        $products = Product::where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $products->category_id)->where('id', '!=', $products->id)->orderBy('id', 'desc')->limit(4)->get();
        $faqs = Faq::all();

        $review_status = 0;
        if(OrderDetail::where('user_id', Auth::id())->where('product_id', $products->id)->whereNull('rating')->exists()){
            $review_status = 1;
            $order_id = OrderDetail::where('user_id', Auth::id())->where('product_id', $products->id)->whereNull('rating')->first()->id;
        } else{
            $review_status = 0;
            $order_id = 0;
        }

        $reviews = OrderDetail::where('product_id', $products->id)->whereNotNull('rating')->get();
        return view('frontend.layouts.pages.product-details', compact('products', 'related_products', 'faqs', 'review_status', 'order_id', 'reviews'));
    }


    public function review(Request $request, $id){
        // dd($request->all());
        OrderDetail::find($id)->update([
            'review' => $request->review,
            'rating' => $request->rating
        ]);
        return back()->with('s_status', 'Thanks For Review!');
    }


    public function contactStore(ContactForm $request){
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


    public function search(Request $request){
        // dd($request->all());
        $categories = Category::all();
        $search = $request->search;
        $catProducts = Product::where('name', 'like', '%'.$search.'%')
                ->orWhere('price', 'like', '%'.$search.'%')
                ->orWhere('short_description', 'like', '%'.$search.'%')
                ->orWhere('quantity', 'like', '%'.$search.'%')
                ->paginate(1);
                // return $catProducts;
        return view('frontend.layouts.pages.category', compact('catProducts', 'categories', 'search'));
    }


    public function subscribeNewsletter(NewsletterForm $request){
        Newsletter::create([
            'email' => $request->email
        ]);
        session()->flash('s_status', 'Thanks for Subscribed Our Newsletter');
        return back();
    }
}
