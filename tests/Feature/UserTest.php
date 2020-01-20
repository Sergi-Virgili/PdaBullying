<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @test
     * @return void
     */
    public function everybody_can_register()
    {
        $this->withoutExceptionHandling();
        $faker = Factory::create();

        $response = $this->json('POST', 'api/register', [

            'name' => $name = $faker->company,
            'email' =>  $faker->unique()->safeEmail,
            'password' => $password = $faker->company,
            'password_confirmation' => $password,

            ])
            ->assertStatus(201);

    }
}
