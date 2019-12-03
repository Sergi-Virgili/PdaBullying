<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(RefugesSeeder::class);
        $this->call(MapsSeeder::class);
        $this->call(Maps_RefugesSeeder::class);
        $this->call(UsersSeeder::class);

    }
}
