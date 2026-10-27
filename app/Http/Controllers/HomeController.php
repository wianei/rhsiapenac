<?php

namespace App\Http\Controllers;

use App\Classes\Tdata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lotacoes = DB::table('lotacaos')->orderBy('sigla','ASC')->get();

        $dados = array();
        foreach(json_decode($lotacoes) as $lotacao)
        {
            $query = DB::table('lotacaos');

            $query->join('servidors', 'servidors.lotacao', '=', 'lotacaos.id');

            $select = $query->where('servidors.lotacao',$lotacao->id)->count();

            array_push($dados, array(
                'lotacao' => $lotacao->sigla,
                'id' => $lotacao->id,
                'coordenadoria' => $lotacao->coordenadoria,
                'quantidade' => $select
            ));
        }
        
        /**
         * quantidade por coordenadoria
         */
        $qtdGabinete = 0;
        $qtdDerGa = 0;
        $qtdDerLi = 0;
        $qtdDerRs = 0;
        $qtdDerSep = 0;
        
        foreach ($dados as $d) {

            switch ($d['coordenadoria']) {
                case 2:
                    $qtdDerGa = $d['quantidade'] + $qtdDerGa;
                    break;

                case 3:
                    $qtdDerLi = $d['quantidade'] + $qtdDerLi;
                    break;

                case 4:
                    $qtdDerRs = $d['quantidade'] + $qtdDerRs;
                    break;

                case 5:
                    $qtdDerSep = $d['quantidade'] + $qtdDerSep;
                    break;

                case 1:
                    $qtdGabinete = $d['quantidade'] + $qtdGabinete;
                    break;


            }

        }


        $servidores = DB::table('servidors')->whereMonth('data_nascimento', Tdata::mes())->select(DB::raw("day(data_nascimento) as dia"), 'data_nascimento', 'lotacao', 'nome')->orderBy('dia','ASC')->orderBy('nome')->orderBy('lotacao')->get();

        $aniversariantes = array();
        foreach (json_decode($servidores) as $item) {
            array_push($aniversariantes,array(
               'nome'=>$item->nome,
               'data' => substr(Tdata::TdataBR($item->data_nascimento),0,5),
               'lotacao'=>LotacaoController::getNomeOrDesc($item->lotacao,"sd"),
            ));
        }

        $mes = Tdata::getMesExt(Tdata::mes());


        return view('home', compact("dados", "mes", "aniversariantes", "qtdDerGa", "qtdDerLi", "qtdDerRs", "qtdDerSep", "qtdGabinete"));
    }
}
