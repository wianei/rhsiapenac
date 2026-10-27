<?php

namespace App\Http\Controllers;

use App\Classes\Tdata;
use App\Classes\Tstring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Classes\Tmenu;

class RelatorioController extends Controller
{
    /**
     * ******
     *  view com o filtro do relatorio
     * ******
     * @param $id - id do menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relatorio($id)
    {

        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano()-1,Tdata::ano());


        return view('relatorio.atestado.relatorio', compact('menuNome', 'lotacao', 'id', 'anos'));
    }


    /**
     * ******
     *  view de retorno da pesquisa
     * ******
     * @param Request $request
     * @param $id - id do menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pesquisar(Request $request, $id)
    {

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        // se passar a matricula
        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }


        $resultadoDB = $query->where('historico.tipo', $id)->where('historico.status', 1)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.data_inicio', 'historico.data_final', 'historico.duracao')->orderBy('historico.data_inicio', 'DESC')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "matricula" => $r['matricula'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "duracao" => $r['duracao']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        // se passar a matricula, a tabela de visualizacao dos dados vai ser diferente
        (!empty($request->get('matricula'))) ? $detalhamento = true : $detalhamento = false;


        return view('relatorio.atestado.resultado', compact('menuNome', 'resultado', 'dataRelatorio','detalhamento'));

    }

    public function afastamento(Request $request, $id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano()-1,Tdata::ano());
        $afastamentos = Tstring::afastamentos();
        json_encode($afastamentos);

        return view('relatorio.afastamento.afastamento', compact('menuNome', 'lotacao', 'id', 'anos', 'afastamentos'));

    }

    public function afastamentoPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        // se passar a matricula
        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        if ($request->get('tipo_afastamento') != "") {
            $query->where('historico.titulo', $request->get('tipo_afastamento'));
        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome','servidors.lotacao','servidors.matricula','historico.data_inicio','historico.data_final','historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "tipo" => $r['titulo'],
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.afastamento.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function concessoes(Request $request, $id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano()-1,Tdata::ano());

        return view('relatorio.concessoes.concessoes', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function concessoesPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }
        // se passar a matricula
        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        if ($request->get('tipo_concessao') != "") {
            $query->where('historico.titulo', $request->get('tipo_concessao'));
        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }


        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "tipo" => $r['titulo'],
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.concessoes.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function ferias($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.ferias.ferias', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function feriasPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.ferias.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function licencas($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());
        $licencas = Tstring::licencas();
        json_encode($licencas);

        return view('relatorio.licencas.licencas', compact('menuNome', 'lotacao', 'id', 'anos', 'licencas'));

    }

    public function licencasPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }


        if ($request->get('tipoLicenca') != "") {
            $query->where('historico.titulo', $request->get('tipoLicenca'));
        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }


        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "tipo" => $r['titulo'],
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.licencas.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function penalidades($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());
        $penalidades = Tstring::penalidades();
        json_encode($penalidades);

        return view('relatorio.penalidades.penalidades', compact('menuNome', 'lotacao', 'id', 'anos', 'penalidades'));

    }

    public function penalidadesPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        if ($request->get('tipoPenalidade') != "") {
            $query->where('historico.titulo', $request->get('tipoPenalidade'));
        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }


        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "tipo" => $r['titulo'],
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.penalidades.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function remocoes($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.remocoes.remocoes', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function remocoesPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('historico.titulo', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['titulo']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.remocoes.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function redistribuicoes($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.redistribuicoes.redistribuicoes', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function redistribuicoesPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.redistribuicoes.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function servidor()
    {
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        return view('relatorio.servidor.servidor', compact('lotacao'));

    }

    public function comissionados()
    {
        $comissionados = DB::table('servidors')->join('funcao', 'servidors.funcao', '=', 'funcao.id')->where('funcao.comissionada','S');
        json_encode($comissionados);

        $resultadoDB = $comissionados->orderBy('servidors.nome', 'ASC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "id" => ServidorController::getIdPelaMatricula($r['matricula']),
                "cargo" => CargoController::getNome($r['cargo']),
                "funcao" => CargoController::getFuncao($r['funcao']),
                "nome" => ServidorController::getNomePelaMatricula($r['matricula']),
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "matricula" => $r['matricula']
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.comissionados.resultado', compact('resultado', 'dataRelatorio'));

    }

    public function servidorPesquisar(Request $request)
    {

        $query = DB::table('servidors')->where('lotacao', $request->get('lotacao'));

        $resultadoDB = $query->orderBy('servidors.nome', 'ASC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($request->get('lotacao')),
                "matricula" => $r['matricula']
            ));


        }


        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.servidor.resultado', compact('resultado', 'dataRelatorio'));

    }

    public function substituicoes($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.substituicoes.substituicoes', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function substituicoesPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.substituicoes.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }

    public function vacancias($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.vacancias.vacancias', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function vacanciasPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.vacancias.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }


    public function elogio($id)
    {
        $menuNome = Tmenu::getNome($id);
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        json_encode($lotacao);

        $anos = array(Tdata::ano() - 1, Tdata::ano());

        return view('relatorio.elogio.elogio', compact('menuNome', 'lotacao', 'id', 'anos'));

    }

    public function elogioPesquisar(Request $request, $id)
    {
        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        if ($request->get('lotacao') != 0) {
            $query->where('servidors.lotacao', $request->get('lotacao'));
        }

        // se passar a matricula
        if (!empty($request->get('matricula'))){
            $query->where('servidors.matricula', '=', $request->get('matricula'));

        }

        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_final
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', $id)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();

        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach (json_decode($resultadoDB, true) as $r) {


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        $menuNome = Tmenu::getNome($id);

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        return view('relatorio.elogio.resultado', compact('menuNome', 'resultado', 'dataRelatorio'));

    }



}
