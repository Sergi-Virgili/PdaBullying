<?php

namespace Tests\Feature\Users;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class IndexUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_see_a_users_list() {

        $user = factory(User::class)->create();

        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);

        $this->actingAs($admin, 'api');

        $response = $this->json('get', '/api/users');

        $response->assertStatus(200);

    }
    /**
     * @test
     */
    public function no_admin_user_cannot_see_a_users_list() {


        $this->actingAs($user = factory(User::class)->create(), 'api');

        $response = $this->json('get', '/api/users');

        $response->assertStatus(403);

    }

}
