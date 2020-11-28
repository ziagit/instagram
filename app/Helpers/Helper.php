<?php

use App\Follow;
use App\User;
use Illuminate\Support\Facades\Auth;

class Helper{

   /**
    * Get all some users
    */
    public static function getUser(){
      $followed = Follow::where("user_1",auth()->id())->get();
      $users = User::join("follows",'users.id','=','follows.user_2')
      ->where("follows.user_2",auth()->id())->where("follows.user_1",'!=',auth()->id())
      
      ->orderBy("follows.created_at",'desc')->get();
      $status = "Follows you";
      if($users->isEmpty()){
         $users = User::where("id",'!=',auth()->id())
         ->orderBy("created_at",'desc')->get();
         $status = "Suggestion";
      }
      return ['users' => $users,'followed' => $followed,'status' => $status];
   }

}
?>