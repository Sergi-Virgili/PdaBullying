<?php

namespace Tests\Feature\Users;

use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class DeleteUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function admin_can_delete_a_user() {

        $user1 = factory(User::class)->create([
            'name' => $name = 'name',
        ]);



        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);



        $this->actingAs($admin, 'api');

        $this->assertDatabaseHas('users', [
            'name' => $name,

        ]);

        $response = $this->json('delete', '/api/users/'.$user1->id);




    }
    /**
     * @test
     */
    public function no_admin_user_cannot_delete_a_user() {

        $user1 = factory(User::class)->create();


        $this->actingAs($user = factory(User::class)->create(), 'api');

        $response = $this->json('delete', '/api/users/'.$user1->id);

        $response->assertStatus(403);

    }

}
