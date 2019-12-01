<?php

use Illuminate\Database\Seeder;

class RefugesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('refuges')->insert([
            'name'=> 'resource1',
            'description'=> 'description1',
            'lat'=> 41.3876768,
            'lng'=> 2.1692590,
        ]);
        DB::table('refuges')->insert([
            'name'=> 'resource2',
            'description'=> 'description2',
            'lat'=> 41.4104479,
            'lng'=> 2.1584852,
        ]);
        DB::table('refuges')->insert([
            'name'=> 'resource3',
            'description'=> 'description3',
            'lat'=> 41.3987704,
            'lng'=> 2.1634544,
        ]);
        DB::table('refuges')->insert([
            'name'=> 'resource4',
            'description'=> 'description4',
            'lat'=>  41.3988499,
            'lng'=> 2.16369090,
        ]);

        //
    }
}
