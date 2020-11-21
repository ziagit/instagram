<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "post_user";
    protected $fillable = ['comment','user_id','post_id'];

    // /**
    //  * The comment that belong to the post
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongTo
    //  */
    // public function post()
    // {
    //     return $this->belongsTo(Post::class);
    // }

    // /**
    //  * The comment that belong to the user
    //  * @return \Illuminate\Database\Eloquent\Relations\BelongTo
    //  */
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
