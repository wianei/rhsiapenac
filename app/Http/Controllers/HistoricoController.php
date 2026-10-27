<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoricoController extends Controller
{
    public static function getNome($id){
        $nome = DB::table('historico_filtros')->where('id',$id)->get();

        return $nome[0]->nome;

    }
}
