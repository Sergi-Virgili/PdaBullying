<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RefugeControllerTest extends TestCase
{
    // EMPTY TABLE
    use RefreshDatabase;
    /**
     *
     */
    public function can_create_refuge()
    {
        //GIVEN
            //User is auth TODO!!
        $faker = Factory::create();

        // WHEN
            //post request create refuge
        $response = $this->json('POST', '/api/refuges', [

            'name' => $name = $faker->company,
            'description' => $description = $faker->text,
            'lat' => $lat = 41.3876768,
            'lng' => $lng = 2.1692590,

        ])
        // ->assertJson([
        //     'name' => $name,
        //     'description' => $description,
        //     'lat' => $lat,
        //     'lng' => $lng,
        // ])
        ->assertStatus(201);

            //test databasehas this refuge
        $this->assertDatabaseHas('refuges', [
            'name' => $name,
            'description' => $description,
            'lat' => $lat,
            'lng' => $lng,
        ]);
    }
}
