<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name'=> 'resource1',
            'description'=> 'description1',
           ]);
        DB::table('types')->insert([
            'name'=> 'resource2',
            'description'=> 'description2',
           ]);
        DB::table('types')->insert([
            'name'=> 'resource3',
            'description'=> 'description3',
           ]);
        DB::table('types')->insert([
            'name'=> 'resource4',
            'description'=> 'description4',
    
            ]);
    }
}
