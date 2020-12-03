<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'image' => 'images/posts/post_image'.rand(1, 7).'.jpg',
        'description' => "Post ".rand(1,7),
    ];
});
