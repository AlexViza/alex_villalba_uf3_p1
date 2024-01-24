<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class ProducerFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $filmIds = DB::table("films")->pluck("id")->toArray();
        foreach ($filmIds as $filmId) {
        //Obtenemos el último id insertado
        $lastInsertedId = DB::table("producer")->max("id");
        //Generamos 20 elementos de tipo aleatorio.
        for ($i = $lastInsertedId; $i < $lastInsertedId+10; $i++) {
        DB::table("producer")->insert(
            [
                "id" => $i + 1,
                "name" => $faker->name(),
                "film_id" => $filmId,
                "created_at" => now()->setTimezone('Europe/Madrid'),
                
            ]
        );
        }
    }
    }
}
