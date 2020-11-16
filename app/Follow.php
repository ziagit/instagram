<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $fillable = [
        'user_1', 'user_2',
    ];

    public $timestamps = false;
}
