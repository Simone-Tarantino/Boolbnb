<?php

use Illuminate\Database\Seeder;
use App\Extra;
use Faker\Generator as Faker;
class ExtrasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $extraArray = [
            'WiFi',
            'Parcheggio',
            'Piscina',
            'Portineria',
            'Sauna'
        ];

        for ($i=0; $i < 5; $i++) { 
            $extra = new Extra;
            $extra->name = $extraArray[$i];
            $extra->save();
        }   
    }
}
