<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class,3)->create();
        factory(App\Post::class, 335)->create([
            'user_id'  => 1,
        ]);

        factory(App\Post::class, 335)->create([
            'user_id'  => 2,
        ]);

        factory(App\Post::class, 335)->create([
            'user_id'  => 3,
        ]);

    }
}
