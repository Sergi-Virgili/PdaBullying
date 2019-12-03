<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function canCreateAUser ()
    {

        $faker = Factory::create();
        

        $response = $this->json('POST', 'api/users', [
            'name' => $name = $faker->company,
            'surName' => $surName = $faker->company,
            'email' => $email = $faker->company,
            'password' => $password = $faker->company,
            'entity' => $entity = $faker->company,
            'street' => $street = $faker->company,
            'number' => $number =  random_int(0,9999),
            'city' => $city = $faker->company,
            'CP' => $CP = random_int(0,9999),
            ])
            ->assertStatus(201);

        $this->assertDatabaseHas('users', [
            'name'=> $name,
            'surName'=> $surName,
            'email'=>$email,
            'password'=>$password,
            'entity'=>$entity,
            'street'=>$street,
            'number'=>$number,
            'city'=>$city,
            'CP'=>$CP,
        ]);
    }
}
