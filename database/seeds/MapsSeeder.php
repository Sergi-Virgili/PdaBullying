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
        ]);
    }
}
