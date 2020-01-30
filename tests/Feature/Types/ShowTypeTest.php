<?php

namespace Tests\Feature\Types;

use App\Type;
use App\User;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTypeTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function all_users_can_see_a_type_detail()
    {

        $type = $this->create('Type');

        $response = $this->json('GET', "api/types");

        $response->assertStatus(200);
    }

}
