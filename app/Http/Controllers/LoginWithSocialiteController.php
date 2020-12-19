<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\File;

class LoginWithSocialiteController extends Controller
{

    /**
     * redirect to the google drover
     */
     public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * get the user from google and check if exist login if do not exist create new
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->orWhere("email",$user->email)->first();
            if($finduser){
                if($finduser->image == "default.png"){
                    $finduser->social_path = $user->avatar_original;
                    $finduser->save();
                }
       
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

    /**
     * redirect user from facebook driver
     */
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * create new account if don't exists
     */
    public function handleFacebookCallback()
    {
        try {
      
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->orWhere("email",$user->email)->first();

            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('/posts');
       
            }else{
                if(!empty($user->getAvatar()))
                {

                    $fileContents = file_get_contents($user->getAvatar());
                    File::put(public_path('images/avatar') .'/'. $user->getId() . ".jpg", $fileContents);


                }
                $imageUrl = $user->getId() . ".jpg";
                $newUser = User::create([
                    'name' => $user->name,
                    'facebook_id'=> $user->id,
                    'image' => $imageUrl,
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
