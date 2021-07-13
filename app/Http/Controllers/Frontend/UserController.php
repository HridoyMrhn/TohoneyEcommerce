<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile(){
        return view('frontend.layouts.dashboard', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }


    public function updateProfile(Request $request){
        $file_name = auth()->user()->image;
        $file_path = public_path('uploads/category/'.$file_name);

        if(request()->hasFile('image')){
            $file = request()->file('image');
            if($file->isValid()){
                if($file_name != 'default.png'){
                    @unlink($file_path);
                }
                $file_type = $file->getClientOriginalExtension();
                $file_name = date('Ymdhms').'.'.$file_type;
                $file->storeAs('user', $file_name);
            }
        }

        User::findOrFail(Auth::id())->update($request->except('_token', 'image') + [
            'image' => $file_name
        ]);
        session()->flash('s_status', 'Your Profile has benen Updated!');
        return back();
    }


    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => ['required', 'min:6', new MatchOldPassword],
            'password' => ['required', 'min:6']
        ]);
        User::findOrFail(Auth::id())->update([
            'password' => Hash::make($request->password)
        ]);
        session()->flash('s_status', 'Your Password has benen Changed!');
        return back();
    }
}
