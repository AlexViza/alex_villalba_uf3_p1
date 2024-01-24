<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        //Obtenemos el último id insertado
        $lastInsertedId = DB::table("films")->max("id");
        //Generamos 20 elementos de tipo aleatorio.
        for ($i = $lastInsertedId; $i < $lastInsertedId+10; $i++) {
        DB::table("films")->insert(
            [
                "id" => $i + 1,
        //Creamos descuentos de hasta el 100% con dos decimales
                "name" => $faker->name(),
                "year" => $faker->numberBetween(1900,2024),
                "genre" => $faker->randomElement(['Drama', 'Action', 'Terror', 'Comedy']),
                "country" => $faker->country(),
                "duration" => $faker->numberBetween(30, 300),
                "img_url" => $faker->imageUrl(),
                "created_at" => now()->setTimezone('Europe/Madrid'),
                
            ]
        );
        }

    }
}
