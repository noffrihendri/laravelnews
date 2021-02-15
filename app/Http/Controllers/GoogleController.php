<?php

namespace App\Http\Controllers;

use App\model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        // jika user masih login lempar ke home
        if (Auth::check()) {
            return redirect('/home');
        }

        $oauthUser = Socialite::driver('google')->user();

        //dd($oauthUser);
        $cekemial = User::where('email', $oauthUser->email)->first();

        if($cekemial){
            $user = User::where('google_id', $oauthUser->id)->first();

            if(!$user){
                $cekemial->google_id = $oauthUser->id;
                $cekemial->save();
            }

            Auth::loginUsingId($cekemial->id);
            return redirect('/home');
        }else{

            //dd("mati disini");
            return redirect('/login')->with('alert', 'Email Anda Tidak Terdaftar');
        }
       
       
    }
}
