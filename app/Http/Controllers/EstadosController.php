<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
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
            foreach($estados["response"]["estado"] as $estado){
                Estado::updateOrCreate([
                    "name"=>$estado
                ]);
            }
        }

        return $estados;

    }
}
