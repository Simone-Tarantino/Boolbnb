<?php

use App\Sponsor;
use Illuminate\Database\Seeder;




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

       for ($i =0; $i <= 2; $i++) {

           $sponsor = new Sponsor;
           $sponsor->duration = $duration[$i];
           $sponsor->price = $price[$i];
           $sponsor->save();

       }
    }
}
