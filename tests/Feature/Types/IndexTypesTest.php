<?php

namespace Tests\Feature\Types;

use App\Type;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTypesTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function all_users_can_see_a_types_list()
    {

        $type1= $this->create('Type');
        $type2= $this->create('Type');
        $type3= $this->create('Type');

        $response = $this->json('GET', '/api/types');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id','name']],

            ]);
    }

}
