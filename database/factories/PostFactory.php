<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'image' => 'images/posts/demo'.rand(1, 6).'.jpg',
        'description' => $faker->realText(128),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
