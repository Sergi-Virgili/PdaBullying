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
        // $faker = factory(Type::class)->create();
        // dd($faker);
        $this->withoutExceptionHandling();


        $response= $this->post('/api/types', [
            'name'=> "RAquel s.a.",
            'description'=> "hola que tal sisi qye tal"
        ]);
        
        $response->assertStatus(201);

        $this->assertDatabaseHas('types', [
        'name'=> "RAquel s.a.",
        'description'=> "hola que tal sisi qye tal"
        ]);
    }
}
