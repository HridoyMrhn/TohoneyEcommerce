<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultipleImage;
use Carbon\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.Product.list', [
            'products' => Product::orderBy('id', 'desc')->paginate(10),
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_name = 'default.png';
        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('product', $file_name);
            }
        }
        $product = Product::insertGetId($request->except('_token', 'image', 'multiple_image') + [
            'image' => $file_name,
            'slug' => Str::slug($request->name).'-'.Str::random(6),
            'created_at' => Carbon::now()
        ]);

        if(request()->hasFile('multiple_image')){
            $seriel = 1;
            foreach($request->file('multiple_image') as $data){
                $file = $data;
                if($file->isValid()){
                    $file_name = $product.'-'.$seriel++.'-'.time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs('multiple_image', $file_name);
                    MultipleImage::create([
                        'product_id' => $product,
                        'multiple_image' => $file_name,
                    ]);
                }
            }
        }
        // session()->flash('s_status', 'Product has been Added!');
        // return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // dd($product->multipleImage);
        $file_name = $product->image;
        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                if($file_name != 'default.png'){
                    @unlink(public_path('uploads/product/'.$file_name));
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('product', $file_name);
            }
        }
        $product->update($request->except('_token', 'image', 'multiple_image') + [
            'image' => $file_name
        ]);

        if(!empty(request()->hasFile('multiple_image'))){
            foreach($product->multipleImage as $data){
                if(file_exists(public_path('uploads/multiple_image/'.$data->multiple_image))){
                    unlink(public_path('uploads/multiple_image/'.$data->multiple_image));
                }
                MultipleImage::where('product_id', $id)->delete();
            }
        }

        if(request()->hasFile('multiple_image')){
            $seriel = 1;
            foreach($request->file('multiple_image') as $data){
                $file = $data;
                if($file->isValid()){
                    $files_name = $product->id.'-'.$seriel++.'-'.time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs('multiple_image', $files_name);
                    MultipleImage::create([
                        'product_id' => $product->id,
                        'multiple_image' => $files_name,
                    ]);
                }
            }
        }
        session()->flash('s_status', 'Product has been Added!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // echo $product;
        $file_name = $product->image;
        $file_path = public_path('uploads/product/'.$file_name);
        if($file_name != 'default.png'){
            @unlink($file_path);
        }
        foreach($product->multipleImage as $data){
            if(file_exists(public_path('uploads/multiple_image/'.$data->multiple_image))){
                @unlink(public_path('uploads/multiple_image/'.$data->multiple_image));
            }
            MultipleImage::where('product_id', $product->id)->delete();
        }
        $product->delete();
        session()->flash('b_status', 'Product has been Deleted!');
        return back();
    }
}
