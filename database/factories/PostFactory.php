<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'image' => 'demo'.rand(1, 6).'.jpg',
        'description' => $faker->realText(128),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});
