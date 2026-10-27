<?php

namespace App\Http\Controllers;

use App\Cargo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MunicipiosController extends Controller
{
    public function getMunicipio(Request $request)
    {
        $municipio = DB::table('municipio')->where('Uf',$request->get('uf'))->orderBy('Nome','ASC')->get();

        $cidades = array();
        foreach(json_decode($municipio) as $m)
        {
            array_push($cidades, $m->Nome);
        }

        return json_encode($cidades);
    }

    public static function municipios($uf)
    {
        $municipio = DB::table('municipio')->where('Uf',$uf)->orderBy('Nome','ASC')->get();

        $cidades = array();
        foreach(json_decode($municipio) as $m)
        {
            array_push($cidades, $m->Nome);
        }

        return json_encode($cidades);
    }
}