<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotVerifyUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'biography', 'email', 'name', 'password',
    ];
}
