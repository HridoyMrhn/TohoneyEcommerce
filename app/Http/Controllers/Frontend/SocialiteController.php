<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function gitRedirect(){
        return Socialite::driver('github')->redirect();
    }

    public function gitCallback()
    {
        $user = Socialite::driver('github')->user();
        if(!User::where('email', $user->getEmail())->exists()){
            User::insert([
                'name' => $user->getNickname(),
                'email' => $user->getEmail(),
                'password' => Hash::make('11221122'),
                'user_name' => Str::slug($user->getNickname()),
                'image' => $user->getAvatar(),
                'role' => 'user',
                'created_at' => Carbon::now()
            ]);
        }
        if(Auth::attempt(['email' =>$user->getEmail(), 'password' => '11221122'])){
            return redirect()->route('profile');
        }
    }
}
