<?php

namespace Tests\Feature\Types;

use App\Type;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUpdateTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function admin_can_update_a_type()
    {

        $type = $this->create('Type');

        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin, 'api');


        $response = $this->json('PUT', "api/types/$type->id", [
            'name' => $type->name.'_updated',

        ]);

        $response->assertStatus(200)
        ->assertExactJson([
            'id' => $type->id,
            'name' => $type->name.'_updated',


        ]);

            $this->assertDatabaseHas('types', [

            'id' => $type->id,
            'name' => $type->name.'_updated',

            ]);
    }

    /**
     * @test
     */

    public function no_admin_can_not_update_a_type() {

        $type = $this->create('Type');

        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');


        $response = $this->json('PUT', "api/types/$type->id", [
            'name' => $type->name.'_updated',

        ]);
        $response->assertStatus(403);
    }
}
