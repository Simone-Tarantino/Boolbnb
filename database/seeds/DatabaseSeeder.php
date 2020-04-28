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
        $this->call(HousesTableSeeder::class);
        $this->call(ExtrasTableSeeder::class);
        $this->call(SponsorsTableSeeder::class);
    }
}
