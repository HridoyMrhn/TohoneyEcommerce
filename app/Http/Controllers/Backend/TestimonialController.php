<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.testimonial.list', [
            'testimonials' => Testimonial::orderBy('id', 'desc')->paginate(10),
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
                $file->storeAs('testimonial', $file_name);
            }
        }
        Testimonial::create($request->except('_token', 'image') + [
            'image' => $file_name,
        ]);
        session()->flash('s_status', 'Testimonial has been Added!');
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
        $testimonial = Testimonial::findOrFail($id);
        $file_name = $testimonial->image;
        $file_path = public_path('uploads/testimonial/'.$file_name);

        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                if($file_name != 'default.png'){
                    @unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('testimonial', $file_name);
            }
        }
        $testimonial->update($request->except('_token', 'image') + [
            'image' => $file_name
        ]);
        session()->flash('s_status', 'Testimonial has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $file_name = $testimonial->image;
        $file_path = public_path('uploads/testimonial/'.$file_name);
        if($file_name != 'default.png'){
            @unlink($file_path);
        }
        $testimonial->delete();
        session()->flash('b_status', 'Testimonial has been Deleted!');
        return back();
    }
}
