<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class FilmController extends Controller
{
    /**
     * Read films from storage
     */
    public static function readFilms(): array {
        $filmsJson = Storage::get('public/films.json');
        $films1 = json_decode($filmsJson, true);
        $films2 = DB::table('films')->select('name', 'year', 'genre', 'country','duration', 'img_url')->get();
        $arrayFilms = json_decode(json_encode($films2), true);
        $films = array_merge($films1, $arrayFilms);

        // // Verifica si la decodificación fue exitosa
        // if (json_last_error() != JSON_ERROR_NONE) {
        //     // Maneja el error de decodificación aquí si es necesario
        //     throw new \RuntimeException('Error decoding JSON file');
        // }

        return $films;
    }

    /**
     * List films older than input year 
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listOldFilms($year = null)
    {        
        $old_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Antiguas (Antes de $year)";    
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] < $year)
                $old_films[] = $film;
        }
        dd($old_films);
        return view('films.list', ["films" => $old_films, "title" => $title]);
    }

    /**
     * List films younger than input year
     * if year is not infomed 2000 year will be used as criteria
     */
    public function listNewFilms($year = null)
    {
        $new_films = [];
        if (is_null($year))
            $year = 2000;

        $title = "Listado de Pelis Nuevas (Después de $year)";
        $films = FilmController::readFilms();

        foreach ($films as $film) {
            if ($film['year'] >= $year)
                $new_films[] = $film;
        }
        return view('films.list', ["films" => $new_films, "title" => $title]);
    }

    /**
     * Lista TODAS las películas o filtra x año o categoría.
     */
    public function listFilms($year = null, $genre = null)
    {
        $films_filtered = [];

        $title = "Listado de todas las pelis";
        $films = FilmController::readFilms();

        //if year and genre are null
        if (is_null($year) && is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);

        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($year) && is_null($genre)) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
            }else if((is_null($year) && !is_null($genre)) && strtolower($film['genre']) == strtolower($genre)){
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }else if(!is_null($year) && !is_null($genre) && strtolower($film['genre']) == strtolower($genre) && $film['year'] == $year){
                $title = "Listado de todas las pelis filtrado x categoria y año";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }
    public function listByYear($year)
    {
        $films_filtered = [];
          
        $title = "Listado de todas las pelis por año";
        $films = FilmController::readFilms();
        
        if (is_null($year))
            return view('films.list', ["films" => $films, "title" => $title]);
        //list based on year or genre informed
        foreach ($films as $film) {
            if (!is_null($year) && $film['year'] == $year) {
                $title = "Listado de todas las pelis filtrado x año";
                $films_filtered[] = $film;
                
            }
        }
        
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function listByGenre($genre = null)
    {
        $films_filtered = [];
 
        $title = "Listado de todas las pelis por genero";
        $films = FilmController::readFilms();
 
        //if year and genre are null
        if (is_null($genre))
            return view('films.list', ["films" => $films, "title" => $title]);
 
        //list based on year or genre informed
        foreach ($films as $film) {
            if ((!is_null($genre)) && strtolower($film['genre']) == strtolower($genre)) {
                $title = "Listado de todas las pelis filtrado x categoria";
                $films_filtered[] = $film;
            }
        }
        return view("films.list", ["films" => $films_filtered, "title" => $title]);
    }

    public function sortByYear() {
        $title = "Listado ordenado por año";
   
        $films = FilmController::readFilms();
 
        // Sort films by year using usort
        usort($films, function ($a, $b) {
            return $b['year'] - $a['year'];
        });
   
        return view('films.list', ["films" => $films, "title" => $title]);
    }

    public function countFilms() {
     
        $title = "Number of movies";
        $films = FilmController::readFilms();
        
        $films = count($films);
       
   
        return view('films.count', ["films" => $films, "title" => $title]);
    }

    // public function createFilm() {
        
    //     $filmExis = FilmController::isFilm($_POST["name"]);
    //     if ($filmExis){
    //         return view('welcome', ["Error" => "Sorry but this film exists"]);
    //     }else{
    //         $films = FilmController::readFilms();
    //         $film = [
    //             "name" => $_POST["name"], 
    //             "country" => $_POST["country"], 
    //             "duration" => $_POST["duration"], 
    //             "year" => $_POST["year"], 
    //             "genre" => $_POST["genre"], 
    //             "img_url" => $_POST["url"]
    //         ];
    //         $films[] = $film; 
    //         $jsonFilm = json_encode($films, JSON_PRETTY_PRINT);
    //         Storage::put('public/films.json', $jsonFilm);
    //         $title = "Listado de Pelis";
    //         return view('films.list', ["films" => $films, "title" => $title]);

    //     }
        
    // }
    public function createFilm() {
        $title = "Listado de Pelis";
        $filmExis = FilmController::isFilm($_POST["name"]);

        $source = env('DATA_SRC', 'database');
        if ($filmExis){
            return view('welcome', ["Error" => "Sorry but this film exists"]);
        }else{
            $films = FilmController::readFilms();
            $film = [
                "name" => $_POST["name"], 
                "country" => $_POST["country"], 
                "duration" => $_POST["duration"], 
                "year" => $_POST["year"], 
                "genre" => $_POST["genre"], 
                "img_url" => $_POST["url"]
            ];
            if($this->isFilm($film)){
                return view('welcome', ["error"=>'movie already exist']);
            }else{
                if($source === 'json'){
                    $films[]= $film;
                    Storage::put("/public/films.json", json_encode($films));
                }else{
                    DB::table('films')->insert($film);
                }
                $films = FilmController::readFilms();
                return view('films.list', ["films" => $films, "title" => $title]);
                
            }



            // $films[] = $film; 
            // $jsonFilm = json_encode($films, JSON_PRETTY_PRINT);
            // Storage::put('public/films.json', $jsonFilm);
             //$title = "Listado de Pelis";
            //return view('films.list', ["films" => $films, "title" => $title]);

        }


        
        
    }

    public function isFilm($name = null):bool {
        $films = FilmController::readFilms();
        $filmExist = false;
        foreach ($films as $film) {

            //We show if the film exists
            if($film["name"]==$name){

                $filmExist = true;

            }
                
        }
        // dd($filmExist);
        return $filmExist;
        
        
    }


}
