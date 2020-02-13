<?php

namespace Tests\Feature\Types;

use App\Type;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteTypesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function admin_can_delete_a_type()
    {


        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);
        $this->actingAs($admin, 'api');

        $type = $this->create('Type');

        $response = $this->json('delete', "api/types/$type->id");

        $response->assertStatus(204)
            ->assertSee(null);

        $this->assertDatabaseMissing('types', ['id' => $type->id]);
    }

    /**
     * @test
     */

    public function no_admin_can_not_delete_a_type() {

        $type = $this->create('Type');

        $user = factory(User::class)->create();

        $this->actingAs($user, 'api');

        $response = $this->json('delete', "api/types/$type->id");

        $response->assertStatus(403);
    }
}
