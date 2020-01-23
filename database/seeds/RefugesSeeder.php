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
            'logoUrl' => 'https://pdabullying.com/uploads/2019/08/Logo-SEER-gestora_thu.png',
            'description'=> 'Prevenció, detecció i actuació davant l’assetjament entre iguals',
            'email'=>'sitio1@gmail.com',
            'phone'=>'626626626',
            'lat'=> 41.3876768,
            'lng'=> 2.1692590,
            'is_Public' =>true
        ]);
        DB::table('refuges')->insert([
    
            'name'=> "Concorci d'educació de Barcelona",
            'logoUrl'=> 'https://pdabullying.com/uploads/2019/08/Logo-Consorci-d-39-Educacio-de-Barcelona_thu.png',
            'description'=> 'hola',
            'email'=>'sitio2@gmail.com',
            'phone'=>'626626626',
            'lat'=> 41.4104479,
            'lng'=> 2.1584852,
            'is_Public' =>false
        ]);
        DB::table('refuges')->insert([
            'name'=> 'Salut i educació emocional',
            'logoUrl' => 'https://pdabullying.com/uploads/2019/08/Logo-SEER-gestora_thu.png',
            'email'=>'sitio3@gmail.com',
            'phone'=>'626626626',
            'description'=> 'description3',
            'lat'=> 41.3987704,
            'lng'=> 2.1634544,
            'is_Public' =>true
        ]);
        DB::table('refuges')->insert([
            'name'=> 'Salut i educació emocional',
            'logoUrl' => 'https://pdabullying.com/uploads/2019/08/Logo-SEER-gestora_thu.png',

            'description'=> 'description4',
            'lat'=>  41.3988499,
            'lng'=> 2.16369090,
            'is_Public' =>false
        ]);

        //
    }
}
