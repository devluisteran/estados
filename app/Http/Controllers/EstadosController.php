<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EstadosController extends Controller
{
    function index(){

        $estados = self::getEstados();
        return view("estados.index", compact("estados"));
    }


    function getEstados(){
        $estados = Estado::all();
        if($estados->isEmpty()){
            //consumir api externa
            $url = env("COPOMEX_TOKEN");
            $response = Http::get("https://api.copomex.com/query/get_estados?token=".$url);
            $estados = $response->json();

            if($estados["error"]==true){
                return [];
            }

            foreach($estados["response"]["estado"] as $estado){
                Estado::updateOrCreate([
                    "name"=>$estado
                ]);
            }

             $estados = Estado::all();
        }

        return $estados;

    }

    function getEstadoByid($id){
        $estado = Estado::find($id);
        return $estado;
    }

    function getMunicipios($id){

        $estado = self::getEstadoByid($id);

        if(!$estado){
            return response()->json(["message"=>"Estado no encontrado"],404);
        }

        $cacheKey = 'municipios' . strtolower($estado->name);

        $municipios = Cache::remember($cacheKey, now()->addHours(24), function () use ($estado) {

            $url = env("COPOMEX_TOKEN");
            $response = Http::get("https://api.copomex.com/query/get_municipio_por_estado/".$estado->name."?token=".$url);
            
            $json_response = $response->json();

            if($json_response["error"]==true){
               return [];
            }

            return $json_response["response"]["municipios"];
        });

        return view("estados.municipios", compact("municipios","estado"));
    }
}
