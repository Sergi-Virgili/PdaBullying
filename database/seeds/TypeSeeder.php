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
            'name'=> 'Prevención',
           ]);
        DB::table('types')->insert([
            'name'=> 'Detección',
           ]);
        DB::table('types')->insert([
            'name'=> 'Actuación',
           ]);
        DB::table('types')->insert([
            'name'=> 'Centro Educativo',
           ]);
        DB::table('types')->insert([
            'name'=> 'Actividad / Proyecto',
            
           ]);
        DB::table('types')->insert([
            'name'=> 'Equipamiento',
            
           ]);
        DB::table('types')->insert([
            'name'=> 'Red Comunitaria',
            
    
            ]);
    }
}
