<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UsersTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    public function a_user_can_create_an_account()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'name' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret', // secret
            'password_confirmation' => 'secret', // secret
        ];

        $this->post('/register', $attributes);

        $this->assertDatabaseHas('users', [
            'name' => $attributes['name'],
            'email' => $attributes['email'],
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_change_display_name()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $attributes = [
            'display_name' => $this->faker->name,
            'email' => $user->email,
            'password' => 'secret',
        ];

        $this->actingAs($user)->patch(route('account.update'), $attributes);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'display_name' => $attributes['display_name'],
        ]);
    }

    /**
     * @test
     */
    public function a_user_can_follow_another()
    {
        //Create users
        $users = factory(User::class, 2)->create();

        //Follow request
        $this->actingAs($users->first())->post(route('account.follow', ['id' => $users->last()->id]));

        $this->assertDatabaseHas('follows', [
            'user_1' => $users->first()->id,
            'user_2' => $users->last()->id,
        ]);
    }
}
