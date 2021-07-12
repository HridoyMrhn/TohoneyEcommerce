<?php

namespace App\Http\Controllers\Backend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.banner.list', [
            'banners' => Banner::latest()->paginate()
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
        $file_name = '';
        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('banner', $file_name);
            }
        }
        Banner::create($request->except('_token', 'image') + [
            'image' => $file_name,
        ]);
        session()->flash('s_status', 'Banner been Added!');
        return back();
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
        $banner = Banner::findOrFail($id);
        $file_name = $banner->image;
        $file_path = public_path('uploads/banner/'.$file_name);

        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                if($file_name != 'banner.png'){
                    @unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('banner', $file_name);
            }
        }
        $banner->update($request->except('_token', 'image') + [
            'image' => $file_name
        ]);
        session()->flash('s_status', 'Banner has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $file_name = $banner->image;
        $file_path = public_path('uploads/banner/'.$file_name);
        if($file_name != 'banner.png'){
            @unlink($file_path);
        }
        $banner->delete();
        session()->flash('b_status', 'Banner has been Deleted!');
        return back();
    }
}
