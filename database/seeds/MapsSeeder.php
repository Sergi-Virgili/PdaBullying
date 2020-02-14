<?php

use Illuminate\Database\Seeder;

class MapsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('maps')->insert([
            'user_id'=> 1,
            'lat' => 41.3876768,
            'lng' => 2.169259,
            'zoom' => 13

        ]);
        DB::table('maps')->insert([
            'user_id'=> 2,
            'lat' => 41.3876768,
            'lng' => 2.169259,
            'zoom' => 13

        ]);
        DB::table('maps')->insert([
            'user_id'=> 3,
            'lat' => 41.3876768,
            'lng' => 2.169259,
            'zoom' => 13

        ]);
    }
}
