<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'biography', 'image', 
        'email', 'name', 'password','social_path','google_id'
        ,'facebook_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /** 
    * The user that belong to the comments.
    */
   public function comments()
   {
       return $this->belongsToMany(Post::class)->withPivot('id','comment','created_at','updated_at');
   }

   /**
    * The user that belong to the follows
    */
    public function user_follows(){
        return $this->belongsTo(Follow::class,"id",'user_2');
    }
}
