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
    public function canReturnACollectionOfPaginatedTypes()
    {
        $type1= $this->create('Type');
        $type2= $this->create('Type');
        $type3= $this->create('Type');

        $response = $this->json('GET', '/api/types');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id','name', 'description']],
                    'links'=> ['first', 'last', 'prev', 'next'],
                    'meta'=> [
                        'current_page', 'last_page', 'from', 'to', 'path', 'per_page', 'total'
                    ]

            ]);

            \Log::info($response->getContent());
    }


    /**
     * @test
     */
    public function canCreateAType()
    {
        $faker = Factory::create();

        $this->withoutExceptionHandling();


        $response= $this->json('POST','/api/types', [
            'name' => $name = $faker->company,
            'description'=> $description = $faker->company
        ]);

        \Log::info(1,[$response->getContent()]);

        $response->assertJsonStructure([
            'id','name', 'description'
        ])
        ->assertJson([
            'name'=>$name,
            'description'=>$description,
        ])->assertStatus(201);

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
    public function willFailWith404IfTypeNotFound(){
        $response = $this->json('get', '/types/-5');

        $response->assertStatus(404);
    }


   /**
     * A basic feature test example.
     *
     * @test
     */
    public function canReturnAType()
    {

        $type = $this->create('Type');

        $response = $this->json('GET', "api/types");

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @test
     */
    public function willGet404IfTypeWeWantUpdateNotExists(){
        $response = $this->json('put', '/types/-1');

        $response->assertStatus(404);
    }


    /**
     * A basic feature test example.
     *
     * @test
     */
    public function canUpdateAType(){
        $type = $this->create('Type');

        $response = $this->json('PUT', "api/types/$type->id", [
            'name' => $type->name.'_updated',
            'description' => $type->description.'_updated'
        ]);

        $response->assertStatus(200)
        ->assertExactJson([
            'id' => $type->id,
            'name' => $type->name.'_updated',
            'description' => $type->description.'_updated'

        ]);

            $this->assertDatabaseHas('types', [

            'id' => $type->id,
            'name' => $type->name.'_updated',
            'description' => $type->description.'_updated',
            ]);
    }

        /**
         * A basic feature test example.
         *
         * @test
         */
        public function willGet404IfTypeWeWantDeleteNotExists(){
            $response = $this->json('DELETE', 'api/types/-1');

            $response->assertStatus(404);
        }

        /**
         * A basic feature test example.
         *
         * @test
         */
        public function canDeleteAType(){
            $type = $this->create('Type');

            $response = $this->json('DELETE', "api/types/$type->id");

            $response->assertStatus(204)
                ->assertSee(null);

            $this->assertDatabaseMissing('types', ['id' => $type->id]);
        }
}
