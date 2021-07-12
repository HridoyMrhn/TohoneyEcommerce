<?php

namespace App\Http\Controllers\Backend;

use App\Models\Cupon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.cupon.list', [
            'cupons' => Cupon::latest()->paginate(10)
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
        $file_name = 'cupon.png';
        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('cupon', $file_name);
            }
        }
        Cupon::create($request->except('_token', 'image') + [
            'image' => $file_name,
        ]);
        // session()->flash('s_status', 'cupon has been Added!');
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
        $cupon = Cupon::findOrFail($id);
        $file_name = $cupon->image;
        $file_path = public_path('uploads/cupon/'.$file_name);

        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                if($file_name != 'cupon.png'){
                    @unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('cupon', $file_name);
            }
        }
        $cupon->update($request->except('_token', 'image') + [
            'image' => $file_name
        ]);
        session()->flash('s_status', 'Cupon has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cupon $cupon)
    {
        $file_name = $cupon->image;
        $file_path = public_path('uploads/cupon/'.$file_name);
        if($file_name != 'cupon.png'){
            @unlink($file_path);
        }
        $cupon->delete();
        session()->flash('b_status', 'Cupon has been Deleted!');
        return back();
    }
}
