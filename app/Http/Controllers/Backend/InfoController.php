<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Info;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.layouts.info.list', [
            'info' => Info::all()
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
        $file_name = 'logo.png';
        if(request()->hasFile('logo')){
            $file = request()->file('logo');
            if($file->isValid()){
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('logo', $file_name);
            }
        }
        Info::create($request->except('_token', 'logo') + [
            'logo' => $file_name,
        ]);
        session()->flash('s_status', 'Site Contact has been Added!');
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
        $info = Info::findOrFail($id);
        $file_name = $info->image;
        $file_path = public_path('uploads/logo/'.$file_name);

        if(request()->hasFile('logo')){
            $file = request()->file('logo');
            if($file->isValid()){
                if($file_name != 'logo.png'){
                    @unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('logo', $file_name);
            }
        }
        $info->update($request->except('_token', 'logo') + [
            'logo' => $file_name
        ]);
        session()->flash('s_status', 'Admin Contact info has been Updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Info $info)
    {
        $file_name = $info->image;
        $file_path = public_path('uploads/category/'.$file_name);
        if($file_name != 'logo.png'){
            @unlink($file_path);
        }
        $info->delete();
        session()->flash('b_status', 'Admin Info has been Deleted!');
        return back();
    }
}
