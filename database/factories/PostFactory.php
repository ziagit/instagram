<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'image' => 'images/posts/post-image'.rand(1, 330).'.jpg',
        'description' => "Post ".rand(1,7),
    ];
});
