<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'image' => 'images/posts/post-image'.rand(1, 335).'.jpg',
        'description' => "This is the post ".rand(1,335),
    ];
});
