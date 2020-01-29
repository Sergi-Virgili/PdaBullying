<?php

namespace Tests\Feature\Refuges;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class CreateRefugesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function auth_user_can_create_a_refuge() {


        $faker = Factory::create();
        $this->actingAs($user = factory(User::class)->create(), 'api');

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
    /**
     * @test
     */
    public function no_auth_user_cannot_create_a_refuge() {


        $faker = Factory::create();
        $this->actingAs($user = factory(User::class)->create());

        $response = $this->json('post', '/api/refuges', [

                    'name' => $name = $faker->company,
                    'description' => $description = $faker->text,
                    'lat' => $lat = 41.3876768,
                    'lng' => $lng = 2.1692590

        ]);



        $this->assertCount(0, Refuge::all());

        $response->assertStatus(401);

    }
    /**
     * @test
     */
    public function auth_user_refuge__created_is_attached_in_self_map() {

        $this->actingAs($user = factory(User::class)->create(), 'api');

        $user->refuges = factory(Refuge::class)->create();
        $map = $user->map;

        $this->assertCount(1, $map::all());

    }
}
