<?php

use Illuminate\Database\Seeder;

class Maps_RefugesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('map_refuge')->insert([
            'map_id'=> 1,
            'refuge_id'=> 1
        ]);
        DB::table('map_refuge')->insert([
            'map_id'=> 1,
            'refuge_id'=> 2
        ]);
    }
}
