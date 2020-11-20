<?php

use App\User;

class Helper{

   /**
    * Get all some users
    */
    public static function getUser(){
       return User::orderBy('id','desc')->take(5)->where("id","!=",auth()->user()->id)->get();
    }

}
?>