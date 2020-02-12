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
        $this->withoutExceptionHandling();
        

        $user1 = factory(User::class)->create([
            'name' => $name = 'Manuel',
        ]);

        $admin = factory(User::class)->create([
            'is_admin' => true
        ]);

        $this->actingAs($admin, 'api');

        $this->assertDatabaseHas('users', [
            'name' => $name,

        ]);
        

        $response = $this->json('delete', '/api/users/'.$user1->id);
        
        $this->assertDatabaseMissing('users', [
            'name' => $name
        ]);
        $response->assertStatus(200);



    }
    /**
     * @test
     */
    public function no_admin_user_cannot_delete_a_user() {

        $user1 = factory(User::class)->create([
            'name' => $name = 'Clara'
        ]);

        $this->actingAs($user = factory(User::class)->make(), 'api');

        $response = $this->json('delete', '/api/users/'.$user1->id);

        $this->assertDatabaseHas('users', [
            'name' => $name]);

        $response->assertStatus(403);
            

    }

}
