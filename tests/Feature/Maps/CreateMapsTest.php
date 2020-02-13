<?php

namespace Tests\Feature\Maps;

use App\Map;
use App\User;
use App\Refuge;
use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;



class CreateMapsTest extends TestCase
{
    use RefreshDatabase;


    /**
     * @test
     */
    public function map_creates_when_user_are_created() {

        //$this->withoutExceptionHandling();
        $faker = Factory::create();

        $this->actingAs($user = factory(User::class)->create());


        $map = Map::first();

        $this->assertCount(1, Map::all());
        $this->assertEquals($user->id, $map->user_id);


    }
}
