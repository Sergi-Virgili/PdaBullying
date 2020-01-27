<?php

namespace Tests\Feature;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class RefugesTest extends TestCase
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
    public function auth_user_can_create_a_refuge() {

        $this->withoutExceptionHandling();
        $faker = Factory::create();
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->json('post', '/api/refuges', [

                    'name' => $name = $faker->company,
                    'description' => $description = $faker->text,
                    'lat' => $lat = 41.3876768,
                    'lng' => $lng = 2.1692590

        ]);

        $refuge = Refuge::first();

        $this->assertCount(1, Refuge::all());

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'type' => 'refuges',
                    'id' => $refuge->id,
                    'attributes' => [
                        'user_id' => $user->id,
                        'name' => $name,
                        'description' => $description,
                        'lat' => $lat = 41.3876768,
                        'lng' => $lng = 2.1692590
                    ],
                    'links' => url('/refuges/'.$refuge->id)
                ]
            ]);
    }
}
