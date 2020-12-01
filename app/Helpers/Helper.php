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
      $users = User::where('id','!=',auth()->id())
      ->whereIn('id', function ($query) {
         return $query->select('user_1')->from('follows')
         ->where("user_2","=",auth()->id())->where('user_1',"!=", Auth::id());
      })->whereNotIn("id",function($query){
         return $query->select("user_2")->from("follows")
         ->where("user_1","=",auth()->id())->where("user_2","!=",auth()->id());
      })->get();

      $status = "Follows you";
      if($users->isEmpty()){
         $users = User::where("id",'!=',auth()->id())
         ->whereNotIn('id',function($query){
            return $query->select("user_2")->from("follows")
            ->where("user_1",'=',auth()->id());
         })
         ->orderBy("created_at",'desc')->get();
         $status = "Suggestion";
      }
      return ['users' => $users,'followed' => $followed,'status' => $status];
   }

}
?>