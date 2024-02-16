<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProducerController extends Controller
{
    /**
     * Read films from storage
     */
    public static function readProducers() {
        
        // $actors = DB::table('actors')->get()->toArray();
        $producers = DB::table('producer')->select('id', 'name', 'film_id')->get();
        $arrayProducer = json_decode(json_encode($producers), true);
        
        

        // Verifica si la decodificación fue exitosa
        // if (json_last_error() != JSON_ERROR_NONE) {
        //     // Maneja el error de decodificación aquí si es necesario
        //     throw new \RuntimeException('Error decoding JSON file');
        // }

        return $arrayProducer;
    }

    
    
    public function listProducers()
    {
        

        $title = "Listado de todos los productores";
        $producers = ProducerController::readProducers();

        //if year and genre are null
        
        return view("producer.list", ["producer" => $producers, "title" => $title]);
    }


    public function updateProducer(Request $request, $id)
{
    $data = $request->only(['name']); 
    $producerUpdated = DB::table('producer')
                        ->where('id', $id)
                        ->update($data);

    if($producerUpdated){
        return response()->json(['action' => $producerUpdated, 'status' => 'True']);
    } else {
        return response()->json(['action' => $producerUpdated, 'status' => 'False']);
    }
}
}


    



