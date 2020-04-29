<?php

use Illuminate\Database\Seeder;
use App\Sponsor;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $duration = [24, 72, 144];
        $price = [2.99, 5.99, 9.99];

        for ($i=0; $i <= 2; $i++) { 

            $sponsorship = new Sponsor;
            $sponsorship->duration = $duration[$i];
            $sponsorship->price = $price[$i];
            $sponsorship->save();

        }
    }
}
