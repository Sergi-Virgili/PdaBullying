<?php
namespace Tests\Feature\Refuges;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class IndexRefugesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function everyone_can_see_a_public_refuges_list() {

        // $this->actingAs($user = factory(User::class)->create());
        // $refuge = factory(Refuge::class)->create();

        // $response = $this->json('delete', '/api/refuges/'.$refuge->id);

        // $this->assertCount(1, Refuge::all());
        // $response->assertStatus(401);

    }
    /**
     * @test
     */
    public function auth_users_can_see_a_non_public_own_refuges_list() {

        // $this->actingAs($user = factory(User::class)->create());
        // $refuge = factory(Refuge::class)->create();

        // $response = $this->json('delete', '/api/refuges/'.$refuge->id);

        // $this->assertCount(1, Refuge::all());
        // $response->assertStatus(401);

    }
    /**
     * @test
     */
    public function auth_users_can_not_see_a_non_public_othes_users_refuges_list() {

        // $this->actingAs($user = factory(User::class)->create());
        // $refuge = factory(Refuge::class)->create();

        // $response = $this->json('delete', '/api/refuges/'.$refuge->id);

        // $this->assertCount(1, Refuge::all());
        // $response->assertStatus(401);

    }
    /**
     * @test
     */
    public function admin_can_see_all_refuges_list() {

        // $this->actingAs($user = factory(User::class)->create());
        // $refuge = factory(Refuge::class)->create();

        // $response = $this->json('delete', '/api/refuges/'.$refuge->id);

        // $this->assertCount(1, Refuge::all());
        // $response->assertStatus(401);

    }
}
