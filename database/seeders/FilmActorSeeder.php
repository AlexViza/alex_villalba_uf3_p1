<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

// Obtenemos todos los IDs de las películas y actores
$filmIds = DB::table("films")->pluck("id")->toArray();
$actorIds = DB::table("actors")->pluck("id")->toArray();

// Generamos elementos de tipo aleatorio.
foreach ($filmIds as $filmId) {
    // Seleccionamos aleatoriamente 1 a 3 actores
    $numActors = $faker->numberBetween(1, min(3, count($actorIds)));
    $actorIdsSubset = $faker->randomElements($actorIds, $numActors);

    // Si no hay actores seleccionados, aseguramos que haya al menos uno
    if (empty($actorIdsSubset)) {
        $actorIdsSubset[] = $faker->randomElement($actorIds);
    }

    // Insertamos en la tabla films_actors
    foreach ($actorIdsSubset as $actorId) {
        DB::table("films_actors")->insert([
            "film_id" => $filmId,
            "actor_id" => $actorId,
            "created_at" => now()->setTimezone('Europe/Madrid'),
        ]);
    }
}

    }
}
