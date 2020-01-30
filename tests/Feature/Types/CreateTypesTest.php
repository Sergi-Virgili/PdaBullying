<?php

namespace Tests\Feature\Types;

use App\Type;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTypesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function admin_can_create_a_type()
    {
        $faker = Factory::create();

        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin, 'api');

        $response= $this->json('POST','/api/types', [
            'name' => $name = $faker->company,

        ]);

        $response->assertJsonStructure([
            'id','name'
        ])
        ->assertJson([
            'name'=>$name,

        ])->assertStatus(201);

        $this->assertDatabaseHas('types', [
            'name'=> $name,

            ]);
    }

    /**
     * @test
     */

    public function no_admin_can_not_create_a_type() {

        $faker = Factory::create();

        $user = factory(User::class)->create();

        $this->actingAs($user, 'api');

        $response= $this->json('POST','/api/types', [
            'name' => $name = $faker->company,
        ]);
        $response->assertStatus(403);
    }
}
