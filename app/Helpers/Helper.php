<?php

use App\Follow;
use App\User;
use Illuminate\Support\Facades\Auth;

class Helper{

   /**
    * Get all some users
    */
    public static function getUser(){
      $followed = Follow::where([
          ['user_1', Auth::id()],
      ])->exists();
      $users = User::join("follows",'users.id','=','follows.user_1')
      ->where("follows.user_2",auth()->id())->where("follows.user_1",'!=',auth()->id())
      ->orderBy("follows.created_at",'desc')->get();
      if($users->isEmpty()){
         $users = User::where("id",'!=',auth()->id())->take(20)
         ->orderBy("created_at",'desc')->get();
      }
      return ['users' => $users,'followed' => $followed];
   }

}
?>