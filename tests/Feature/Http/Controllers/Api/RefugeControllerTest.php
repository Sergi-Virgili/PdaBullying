<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RefugeControllerTest extends TestCase
{
    /**
     *
     * @test
     * @return void
     */
    public function can_create_refuge()
    {
        //GIVEN
            //User is auth TODO!!
        $faker = Factory::create();
        // WHEN
        $response = $this->json('POST', '/api/refuges', [
            'name' => $name = $faker->company,
            'description' => $description = $faker->text,
            'lat' => $lat = 41.3876768,
            'lng' => $lng = 2.1692590,

        ]);
            //post request create refuge

        // THEN
            // The refuge exists
            // test status

            //test databe has
        $response->assertStatus(201);
        $this->assertDatabaseHas('refuges', [
            'name' => $name,
            'description' => $description,
            'lat' => $lat,
            'lng' => $lng,
        ]);
    }
}
