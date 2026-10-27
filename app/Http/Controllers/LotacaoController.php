<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Lotacao;
use Illuminate\Http\Request;

class LotacaoController extends Controller
{
    public static function getNomeOrDesc($id, $tipo = "s")
    {
        // se não tiver lotacao
        if ($id == 0) {
            return "sem lotação";
        } else {

            $lotacao = DB::table('lotacaos')->where('id', '=', $id)->get();

            if ($tipo == "s") {
                return $lotacao[0]->sigla;
            }

            if ($tipo == "d") {
                return $lotacao[0]->descricao;
            }

            if ($tipo == "sd") {
                return $lotacao[0]->sigla . " - " . $lotacao[0]->descricao;
            }
        }

    }

    public function iframeServidoresLotacao($id)
    {
        $dados = DB::table('servidors')->where('lotacao',$id)->orderBy('nome','ASC')->get();

        return view('lotacao.resultado_servidor_lotacao_iframe', compact('dados'));

    }

}
