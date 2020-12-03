<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoginWithSocialiteController extends Controller
{
     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/posts');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => bcrypt('instagram123'),
                    'social_path' => $user->avatar_original
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/posts');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage()."kk");
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {
      
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/posts');
       
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'facebook_id'=> $user->id,
                    'password' => bcrypt('password@123'),
                ]);
      
                Auth::login($newUser);
      
                return redirect()->intended('/posts');
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}