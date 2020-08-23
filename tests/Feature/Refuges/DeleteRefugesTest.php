<?php

namespace Tests\Feature\Refuges;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class DeleteRefugesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function no_auth_user_can_not_delete_a_refuge()
    {


        $refuge = factory(Refuge::class)->create();

        $response = $this->json('delete', '/api/refuges/' . $refuge->id);

        $this->assertCount(1, Refuge::all());
        $response->assertStatus(401);
    }
    /**
     * @test
     */
    public function auth_user_can_delete_own_refuge()
    {

        $this->actingAs($user = factory(User::class)->create([
            'id' => 2
        ]), 'api');

        $refuge = factory(Refuge::class)->create([
            'user_id' => $user->id
        ]);

        $response = $this->json('delete', '/api/refuges/' . $refuge->id);
        $this->assertCount(0, Refuge::all());
        $response->assertStatus(200);
    }
    /**
     * @test
     */
    public function auth_user_can_not_delete_other_users_refuges()
    {

        $this->actingAs($user = factory(User::class)->create([
            'id' => 2,
            'is_admin' => false
        ]), 'api');

        $refuge = factory(Refuge::class)->create([
            'user_id' => 4
        ]);

        $response = $this->json('delete', '/api/refuges/' . $refuge->id);
        $response->assertStatus(403);
        $this->assertCount(1, Refuge::all());
    }
    /**
     * @test
     */
    public function admin_can_delete_all_refuges()
    {

        $this->actingAs($user = factory(User::class)->create([
            'is_admin' => true
        ]), 'api');

        $refuge = factory(Refuge::class)->create([
            'user_id' => 33
        ]);

        $response = $this->json('delete', '/api/refuges/' . $refuge->id);
        $this->assertCount(0, Refuge::all());
        $response->assertStatus(200);
    }
    // public function all_attaches_map_deleted_when_refuge_is_deleted() {


    // }
}
