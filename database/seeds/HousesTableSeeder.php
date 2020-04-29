<?php

use Illuminate\Database\Seeder;
use App\House;
use App\User;
use Faker\Generator as Faker;

class HousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $newHouse = new House;
            $newHouse->user_id = User::inRandomOrder()->first()->id;
            $newHouse->room_number = $faker->numberBetween($min = 1, $max = 5);
            $newHouse->bed = $faker->numberBetween($min = 1, $max = 10);
            $newHouse->bathroom = $faker->numberBetween($min = 1, $max = 5);
            $newHouse->mq = $faker->randomFloat($nbMaxDecimals = 2, $min = 50, $max = 900);
            $newHouse->address = $faker->address();
            $newHouse->description = $faker->realText($maxNbChars = 200, $indexSize = 2);
            $newHouse->latitude = $faker->latitude($min = -90, $max = 90);
            $newHouse->longitude = $faker->longitude($min = -180, $max = 180);
            $newHouse->img_path = 'https://picsum.photos/200';
            $newHouse->status = rand(0, 1);
            $newHouse->description = 'Descrizione';
            $newHouse->save();                             
        }
    }

}
