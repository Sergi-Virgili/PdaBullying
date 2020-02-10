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
            'name'=> 'Salut i educació emocional',

            'description'=> 'Prevenció, detecció i actuació davant l’assetjament entre iguals',
            'email'=>'sitio1@gmail.com',
            'phone'=>'626626626',
            'lat'=> 41.3876768,
            'lng'=> 2.1692590,
            'is_Public' =>true
        ]);
        DB::table('refuges')->insert([

            'name'=> "Concorci d'educació de Barcelona",

            'description'=> 'Prevenció, detecció i actuació davant l’assetjament entre iguals. Prevenció, detecció i actuació davant l’assetjament entre iguals',
            'email'=>'sitio2@gmail.com',
            'phone'=>'626626626',
            'lat'=> 41.4104479,
            'lng'=> 2.1584852,
            'is_Public' =>false
        ]);
        DB::table('refuges')->insert([
            'name'=> 'Salut i educació emocional',

            'email'=>'sitio3@gmail.com',
            'phone'=>'626626626',
            'description'=> 'Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor N. del T. persona que se dedica a la imprenta desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. ',
            'lat'=> 41.3987704,
            'lng'=> 2.1634544,
            'is_Public' =>true
        ]);

        DB::table('refuges')->insert([

            'name'=> "Concorci d'educació de Barcelona",

            'description'=> 'Prevenció, detecció i actuació davant l’assetjament entre iguals. Prevenció, detecció i actuació davant l’assetjament entre iguals',
            'email'=>'sitio4@gmail.com',
            'phone'=>'626626626',
            'lat'=> 41.4104479,
            'lng'=> 2.1584852,
            'is_Public' =>true,
            'user_id' =>'2'
        ]);

    }
}
