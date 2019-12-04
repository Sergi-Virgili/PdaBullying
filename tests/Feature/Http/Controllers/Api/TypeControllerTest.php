<?php

namespace Tests\Feature\Http\Controllers\Api;

use Faker\Factory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Type;

class TypeControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function canCreateAType()
    {
        $faker = Factory::create();

        $this->withoutExceptionHandling();


        $response= $this->post('/api/types', [
            'name' => $name = $faker->company,
            'description'=> $description = $faker->company
        ]);
        $response->assertStatus(201);

        $this->assertDatabaseHas('types', [
        'name'=> $name,
        'description'=> $description
        ]);
    }

   /**
     * A basic feature test example.
     *
     * @test
     */
    public function canReturnAType()
    {
        
        $type = $this->create('Type');

        $response = $this->json('GET', "api/types/$type->id");

        $response->assertStatus(200);
    }
    
}
