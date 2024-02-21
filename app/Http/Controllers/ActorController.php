<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Actor;


class ActorController extends Controller
{
    /**
     * Read films from storage
     */
    public static function readActors() {
        
        // $actors = DB::table('actors')->get()->toArray();
        //$actors = DB::table('actors')->select('name', 'surname', 'birtdate', 'country', 'img_url')->get();
        $actors = Actor::where('name', 'surname', 'birtdate', 'country', 'img_url')->get();
        $arrayActors = json_decode(json_encode($actors), true);
        
        

        // Verifica si la decodificación fue exitosa
        // if (json_last_error() != JSON_ERROR_NONE) {
        //     // Maneja el error de decodificación aquí si es necesario
        //     throw new \RuntimeException('Error decoding JSON file');
        // }

        return $arrayActors;
    }

    
    
    public function listActors()
    {
        

        $title = "Listado de todos los actores";
        $actors = ActorController::readActors();

        //if year and genre are null
        
        return view("actors.list", ["actors" => $actors, "title" => $title]);
    }


    
    public function listActorsByDecade(Request $request)
{
    $birtdate = $request->input('decades');
    $actors_filtered = [];
      
    $title = "Listado de Actores por Década";
    
    if (is_null($birtdate)) {
        //$actors = DB::table('actors')->get()->toArray();
        $actors = ActorController::readActors();
    } else {
        $start_year = $birtdate;
        $end_year = $birtdate + 9;
        
        $actors = DB::table('actors')
                    ->select('name', 'surname', 'birtdate', 'country', 'img_url')            
                    ->whereYear('birtdate', '>=', $start_year)
                    ->whereYear('birtdate', '<=', $end_year)
                    ->get()
                    ->toArray();
        
        
        $actors_filtered = json_decode(json_encode($actors), true);
        $title .= " ($start_year - $end_year)";
    }
    
    return view("actors.list", ["actors" => $actors_filtered, "title" => $title]);
}

    

    

    public function countActors() {
     
        $title = "Number of Actors";
        $actors = ActorController::readActors();
        
        $totalactors = count($actors);
       
   
        return view('actors.count', ["totalactors" => $totalactors, "title" => $title]);
    }

    public function deleteActor($id)
{
    //$actorDeleted = DB::table('actors')->where('id', $id)->delete();
    $actorDeleted = Actor::find($id); // Obtener el usuario con ID = 1
    $actorDeleted->delete();
    if($actorDeleted){
        return response()->json(['action' => $actorDeleted, 'status' => 'True']);
    }else{
        return response()->json(['action' => $actorDeleted, 'status' => 'False']);

    }
}


}
