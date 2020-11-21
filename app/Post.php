<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'image', 'description',
    ];

    /**
     * The post that belong to the user.
     * @return \Illuminate\Database\Eloquent\Relations\BelongTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    // /**
    //  * post has many comments
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function comments()
    // {
    //     return $this->hasMany(Comment::class);
    // }
    /**
     * The characteristic that belong to the product.
     */
    public function comments()
    {
        return $this->belongsToMany(User::class)->withPivot('id','comment','created_at','updated_at');
    }
}
