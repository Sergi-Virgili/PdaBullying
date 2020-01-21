<?php

namespace Tests\Feature;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;



class UserTest extends TestCase
{
    use RefreshDatabase;



    // public function setUp() {

    //     parent::setUp();
    //     $this->artisan('passport:client --personal');
    //     $this->artisan('passport:install');
    // }

    /**
     * @test
     */
    public function expect_login_returns_token() {

        $this->withoutExceptionHandling();
        $this->artisan('passport:install');
        $user = User::create([
            'name' => 'name',
            'email' => 'test@test.com',
            'password' => bcrypt('secret')
        ]);
        $response = $this->json('POST', '/api/login', [
            'email' => 'test@test.com',
            'password' => 'secret'
            ]);

        $response->assertStatus(200)
        ->assertJsonStructure(['user', 'access_token']);
    }

     /**
     * @test
     */
    public function everybody_can_register()
    {

        $this->artisan('passport:install');
       // $faker = Factory::create();

        $response = $this->json('POST', '/api/register', [

            'name' => 'name',
            'email' =>  'email2@email.com',
            'password' => 'secret',
            'password_confirmation' => 'secret',

            ]);

            $response->assertStatus(200)
            ->assertJsonStructure(['user', 'access_token']);
    }
}
