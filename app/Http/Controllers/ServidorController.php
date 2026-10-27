<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Classes\Constantes;
use App\Classes\Tstring;
use App\Contato;
use App\Historico;
use App\Lotacao;
use App\Servidor;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Classes\Tdata;
use App\Classes\Tmenu;
use Illuminate\Support\Facades\File;

class ServidorController extends Controller
{
    private $servidor;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Servidor $servidor)
    {
        $this->servidor = $servidor;

        $this->middleware('auth', ['except' => 'webServiceFotosServidor']);
    }

    public static function getNome($id)
    {
        $servidor = DB::table('servidors')->where('id', $id)->select('nome')->get();

        return $servidor;
    }

    public static function getNomePelaMatricula($matricula)
    {
        $servidor = DB::table('servidors')->where('matricula', $matricula)->select('nome')->get();
        return json_decode($servidor)[0]->nome;
    }

    public static function getIdPelaMatricula($matricula)
    {
        $servidor = DB::table('servidors')->where('matricula', $matricula)->select('id')->get();
        return json_decode($servidor)[0]->id;
    }

    /*
     * faz a pesquisa dos servidores
     */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function pesquisa(Request $request)
    {
        $lotacaoDB = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();

        $cursosDB = Tstring::cursosSuperiores();

        $cargos = DB::table('cargos')->orderBy('nome','ASC')->get();
        $funcoes = DB::table('funcao')->orderBy('nome','ASC')->get();


        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        /**
         * se não realizar uma busca
         * - Evita que mostre todos os resultados sem realizar uma busca
         */
        if(!strpos($url,"?"))
        {

            $dados = false;

        }else {

            $servidor = DB::table('servidors');

            $servidor->join('lotacaos', 'lotacaos.id', '=', 'servidors.lotacao');

            $cursos = Input::get('cursos');

            if($cursos != null)
            {
                $servidor->join('cursos_superiores','id_servidor', '=', 'servidors.id');

                $servidor->whereIn('cursos_superiores.curso',$cursos);

            }

            $nome = Input::get('nome');
            $matricula = Input::get('matricula');
            $cpf = Input::get('cpf');
            $lotacao = Input::get('lotacao');
            $nivel = Input::get('nivel');
            $grauInstrucao = Input::get('grau_instucao');
            $sexo = Input::get('sexo');
            $cargo = Input::get('cargo');
            $funcao = Input::get('funcao');

            if ($nome != null) {
                $servidor->where('servidors.nome', 'LIKE', '%' . $nome . '%');
            } if ($matricula != null) {
                $servidor->where('servidors.matricula', $matricula);
            } if ($cpf != null) {
                $servidor->where('servidors.cpf', $cpf);
            } if ($lotacao != null) {
                $servidor->where('servidors.lotacao', $lotacao);
            } if ($nivel != null) {
                $servidor->where('servidors.nivel', $nivel);
            } if ($grauInstrucao != null) {
                $servidor->where('servidors.grau_instucao', $grauInstrucao);
            } if ($sexo != null) {
                $servidor->where('servidors.sexo', $sexo);
            }if ($cargo != null) {
                $servidor->where('servidors.cargo', $cargo);
            }if ($funcao != null) {
                $servidor->where('servidors.funcao', $funcao);
            }

            // passa a query para a paginacao "->appends..."
            $dados = $servidor->select("servidors.nome","servidors.id","servidors.matricula","lotacaos.sigla")->orderBy('servidors.nome','ASC')->paginate(50)->appends($request->input());



        }


        return view('servidor.pesquisa', compact("lotacaoDB","cursosDB",'dados',"cargos","funcoes"));
    }

    public function pesquisaIframe()
    {
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();

        return view('servidor.pesquisaIframe', compact("lotacao"));
    }
    public function pesquisaIframeResultado(Request $request)
    {
        /**
         *  Seta todos os filtros da pesquisa
         */
        $nome = $request->input('nome');
        $matricula = $request->input('matricula');
        $lotacao = $request->input('lotacao');
        $sexo = $request->input('sexo');



        // define a tabela
        $query = DB::table('servidors');
        /**
         *  -------- IMPORTANTE! -----------
         *  para adicionar mais filtros para pesquisa, tem que colocar
         *  o name do campo dentro do array abaixo
         */
        $campos = array('nome', 'matricula', 'lotacao', 'sexo');
        foreach ($campos as $campo) {
            // verifica se o campo exite e se é vazio
            if (isset($$campo) && !empty($$campo)) {
                // create a new condition
                $query = $query->where($campo, 'LIKE', '%' . $$campo . '%');
            }
        }

        // armazena os dados dos servidores
        $servidores = $query->orderBy('nome', 'asc')->get();


        // cria o array com os dados que retornaram da pesquisa
        $dados = array();
        foreach ($servidores as $servidor) {

            array_push($dados, array(
                "id" => $servidor->id,
                "nome" => $servidor->nome,
                "matricula" => $servidor->matricula,
                "lotacao" => LotacaoController::getNomeOrDesc($servidor->lotacao)
            ));

        }

        return view('template._resultado_pesquisa_iframe', compact("dados"));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();
        $cursos = Tstring::cursosSuperiores();
        $secretarias = Tstring::secretariasEstadoBA();
        $cargos = DB::table('cargos')->orderBy('nome','ASC')->get();
        $funcoes = DB::table('funcao')->orderBy('nome','ASC')->get();


        return PermissaoController::temPermissao(PermissaoController::$idSetorPessoal) ?
            view('servidor.cadastro', compact("lotacao", "cursos","secretarias","cargos","funcoes")) :
            redirect('home')->with('alert-danger', 'Você não tem permissão para acessar a página.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$dataForm = $request->except('_token', 'fone', 'inputFile','dep_qtd','dep_nome','dep_parentesco','dep_nascimento');

        if (PermissaoController::temPermissao(PermissaoController::$idSetorPessoal)) {

            $unique = DB::table('servidors')->where('matricula', $request->get('matricula'))->orWhere('cpf', $request->get('cpf'))->get();

            if (count($unique) >= 1) {
                return redirect()->back()->withInput()->with('alert-danger', 'CPF ou Matrícula já cadastrado no sistema');
            }


            $dataForm = $request->except('_token', 'fone', 'inputFile', 'dep_qtd', 'dep_nome', 'dep_parentesco', 'dep_nascimento', 'cursos');

            // mudar os campos para o formato yyyy-mm-dd
            $dataForm['data_nascimento'] = Tdata::TdataMysql($dataForm['data_nascimento']);
            $dataForm['rg_data_expedicao'] = Tdata::TdataMysql($dataForm['rg_data_expedicao']);
            $dataForm['data_admissao_estado'] = Tdata::TdataMysql($dataForm['data_admissao_estado']);
            $dataForm['data_nomeacao'] = Tdata::TdataMysql($dataForm['data_nomeacao']);
            $dataForm['data_posse'] = Tdata::TdataMysql($dataForm['data_posse']);
            $dataForm['data_exercicio'] = Tdata::TdataMysql($dataForm['data_exercicio']);

            // se os campos de datas estivivem vazios, para não retorna erro no bd, assumem o valor null
            if ($dataForm['data_nascimento'] == "") {
                $dataForm['data_nascimento'] = (NULL);
            }

            if ($dataForm['rg_data_expedicao'] == "") {
                $dataForm['rg_data_expedicao'] = (NULL);
            }
            if ($dataForm['data_admissao_estado'] == "") {
                $dataForm['data_admissao_estado'] = (NULL);
            }
            if ($dataForm['data_nomeacao'] == "") {
                $dataForm['data_nomeacao'] = (NULL);
            }
            if ($dataForm['data_posse'] == "") {
                $dataForm['data_posse'] = (NULL);
            }
            if ($dataForm['data_exercicio'] == "") {
                $dataForm['data_exercicio'] = (NULL);
            }


            $fone = $request->input('fone');

            $idServidor = $this->servidor->create($dataForm)->id;

            // se fone for diferente de null, insere os dados na tabela
            if ($fone[0] != null) {

                foreach ($fone as $f) {

                    $insertFone = DB::table('contatos')->insert(
                        ['id_servidor' => $idServidor,
                            'numero' => $f]
                    );

                }
            }

            // ----------------- Inclusão dos dependentes ----------------------------- //
            $dep_qtd = count(collect($request->get('dep_nome')));
            $dep_nome = $request->get('dep_nome');
            $dep_parentesco = $request->get('dep_parentesco');
            $dep_nascimento = $request->get('dep_nascimento');

            for ($x = 0; $x < $dep_qtd; $x++) {
                $insertDependente = DB::table('dependentes')->insert([
                    'id_servidor' => $idServidor,
                    'nome' => $dep_nome[$x],
                    'parentesco' => $dep_parentesco[$x],
                    'data_nascimento' => Tdata::TdataMysql($dep_nascimento[$x])
                ]);
            }
            // ----------------- !Inclusão dos dependentes ----------------------------- //


            // ----------------- inclusão dos cursos ----------------------------- //


            $cursos = $request->get('cursos');
            if ($cursos != null) {
                foreach ($cursos as $curso => $c) {
                    $insertCursoSuperior = DB::table('cursos_superiores')->insert([
                        'id_servidor' => $idServidor,
                        'curso' => $c,
                        'created_at' => Tdata::TdataHojeMysql()
                    ]);

                }
            }

            // ----------------- !inclusão dos cursos ----------------------------- //

            if ($request->hasFile('inputFile')) {

                $image = $request->file('inputFile');

                // faz a validação da imagem
                $extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
                if (!in_array($image->getClientOriginalExtension(), $extensions)) {
                    return redirect()->back()->withInput()->with('alert-danger', 'O tipo do arquivo que você está tentando enviar não é permitido! Envie apenas arquivos com as extensões: jpg, jpeg ou png.');
                }


                $destinationPath = Constantes::ARVQUIVOS_SERVIDORES . "/" . $idServidor . "/foto";

                $originalName = explode(".", $image->getClientOriginalName());

                $name = $idServidor . '.' . $image->getClientOriginalExtension();

                $image->storeAs($destinationPath, $name);
            }


            if ($idServidor != "" || $idServidor != "null") {

                LogServidorController::addLog($idServidor, "<i>Inclusão no sistema</i>");

                return redirect('home')->with('alert-success', 'Cadastro realizado com sucesso!');

            } else {

                return redirect('servidor_cadastro')->with('alert-danger', 'Ocorreu um problema ao salvar o formulário, por favor, tente novamente');

            }
        } else {
            return redirect('home')->with('alert-danger', 'Você não tem permissão para isso.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servidor $servidor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dados = json_decode($servidor);
        //dd($dados[0]);
        $dados[0]->data_nascimento = Tdata::TdataBR($dados[0]->data_nascimento);
        $dados[0]->rg_data_expedicao = Tdata::TdataBR($dados[0]->rg_data_expedicao);
        $dados[0]->data_admissao_estado = Tdata::TdataBR($dados[0]->data_admissao_estado);
        $dados[0]->data_nomeacao = Tdata::TdataBR($dados[0]->data_nomeacao);
        $dados[0]->data_posse = Tdata::TdataBR($dados[0]->data_posse);

        $dados[0]->residencia_estado = Tstring::nomeUf($dados[0]->residencia_estado);
        $dados[0]->naturalidade_uf = Tstring::nomeUf($dados[0]->naturalidade_uf);
        $dados[0]->rg_uf = Tstring::nomeUf($dados[0]->rg_uf);
        $dados[0]->titulo_eleitor_uf = Tstring::nomeUf($dados[0]->titulo_eleitor_uf);

        $dados[0]->lotacao = LotacaoController::getNomeOrDesc($dados[0]->lotacao, "sd");
        //dd($teste);

        $dadosView = json_encode($dados);

// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------

        /**
         *  Carrega os dados de contato
         */
        $contatos = DB::table('contatos')->where('id_servidor', '=', $id)->get();
        $dadosContato = json_encode($contatos);

        $dependentes = DB::table('dependentes')->where('id_servidor', '=', $id)->select(DB::raw("DATE_FORMAT(data_nascimento,'%d/%m/%Y') as nascimento"), 'nome', 'parentesco')->get();

        $cursosRealizados = DB::table('cursos_superiores')->where("id_servidor", $id)->select('curso')->get();
        $cursos = "";
        foreach (json_decode($cursosRealizados, true) as $cursoReal => $cr) {
            $cursos .= $cr['curso'] . ", ";
        }


        return view('servidor.show', compact('dadosView', 'dadosContato', 'foto', 'dependentes', 'cursos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servidor $servidor
     * @return \Illuminate\Http\Response
     */
    public function edit(Servidor $servidor, $id)
    {
        $servidor = $servidor->find($id);

        $servidor->data_nascimento = Tdata::TdataBR($servidor->data_nascimento);
        $servidor->rg_data_expedicao = Tdata::TdataBR($servidor->rg_data_expedicao);
        $servidor->data_admissao_estado = Tdata::TdataBR($servidor->data_admissao_estado);
        $servidor->data_nomeacao = Tdata::TdataBR($servidor->data_nomeacao);
        $servidor->data_posse = Tdata::TdataBR($servidor->data_posse);
        $servidor->data_exercicio = Tdata::TdataBR($servidor->data_exercicio);

        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();

        $municipio = MunicipiosController::municipios($servidor->naturalidade_uf);
        json_encode($servidor->data_posse);

        $contatos = DB::table('contatos')->where('id_servidor', '=', $id)->get();
        $dependentes = DB::table('dependentes')->where('id_servidor', '=', $id)->select(DB::raw("DATE_FORMAT(data_nascimento,'%d/%m/%Y') as nascimento"), 'nome', 'parentesco')->get();

        $dadosContato = json_encode($contatos);

// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------

        $cursos = Tstring::cursosSuperiores();
        $cursosRealizados = DB::table('cursos_superiores')->where("id_servidor", $id)->select('curso')->get();
        $cursosHidden = "";
        foreach (json_decode($cursosRealizados, true) as $cursoReal => $cr) {
            $cursosHidden .= $cr['curso'] . ",";
        }
        substr($cursosHidden, 0, -1);

        $secretarias = Tstring::secretariasEstadoBA();

        $cargos = DB::table('cargos')->orderBy('nome','ASC')->get();
        $funcoes = DB::table('funcao')->orderBy('nome','ASC')->get();


        return view('servidor.cadastro', compact('servidor', "dadosContato", "lotacao", "dependentes", "foto", "cursos", "cursosHidden","municipio","secretarias","cargos","funcoes"));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Servidor $servidor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servidor $servidor)
    {

        $dataForm = $request->except('_token', 'fone', 'inputFile', 'idServidor', 'dep_qtd', 'dep_nome', 'dep_parentesco', 'dep_nascimento', 'cursos');

        $idServidor = $request->input('idServidor');
        $fone = $request->input('fone');

        $unique = DB::table('servidors')->where('matricula', $request->get('matricula'))->orWhere('cpf', $request->get('cpf'))->get();

        if (count($unique) > 1) {
            return redirect()->back()->withInput()->with('alert-danger', 'CPF ou Matrícula já cadastrado no sistema');
        }

        // apos a alteracao de alguns dados vai redicionar para cadastro no historico
        $redirectHistorico = false;

        // mudar os campos para o formato yyyy-mm-dd
        $dataForm['data_nascimento'] = Tdata::TdataMysql($dataForm['data_nascimento']);
        $dataForm['rg_data_expedicao'] = Tdata::TdataMysql($dataForm['rg_data_expedicao']);
        $dataForm['data_admissao_estado'] = Tdata::TdataMysql($dataForm['data_admissao_estado']);
        $dataForm['data_nomeacao'] = Tdata::TdataMysql($dataForm['data_nomeacao']);
        $dataForm['data_posse'] = Tdata::TdataMysql($dataForm['data_posse']);
        $dataForm['data_exercicio'] = Tdata::TdataMysql($dataForm['data_exercicio']);

        // se os campos de datas estivivem vazios, para não retorna erro no bd, assumem o valor null
        if ($dataForm['data_nascimento'] == "") {
            $dataForm['data_nascimento'] = (NULL);
        }

        if ($dataForm['rg_data_expedicao'] == "") {
            $dataForm['rg_data_expedicao'] = (NULL);
        }
        if ($dataForm['data_admissao_estado'] == "") {
            $dataForm['data_admissao_estado'] = (NULL);
        }
        if ($dataForm['data_nomeacao'] == "") {
            $dataForm['data_nomeacao'] = (NULL);
        }
        if ($dataForm['data_posse'] == "") {
            $dataForm['data_posse'] = (NULL);
        }

        if ($dataForm['data_exercicio'] == "") {
            $dataForm['data_exercicio'] = (NULL);
        }

        // ---------------  Faz o log de alteracao de dados -----------------------------------------

        //pega os dados do servidor que estao registrados no BD
        $dadosBD = $servidor->where('id', $idServidor)->get();
        json_decode($dadosBD[0]);

        $diferencas = array();

        // foreach que verifica o que eh igual e o que eh diferente no BD
        foreach ($dataForm as $k => $v) {

            // o que for igual
            if ($dataForm[$k] == json_decode($dadosBD[0], true)[$k]) {

            } // o que for diferente do BD
            else {
                // verifica se eh uma inclusao
                if (json_decode($dadosBD[0], true)[$k] == null) {
                    $alteracoes = "Inclusão de dados no campo " . ucfirst(str_replace("_", " ", $k)) . ": <i><strong>" . $dataForm[$k] . "</i></strong><br>";
                    array_push($diferencas, $alteracoes);

                } // se for alteracao
                else {
                    // tratamento dos dados de log
                    switch ($k) {
                        case "lotacao":
                            $alteracoes = "Alteração do campo " . ucfirst(str_replace("_", " ", $k)) . " de: <i>" . LotacaoController::getNomeOrDesc(json_decode($dadosBD[0], true)[$k]) . "</i> para: <i><strong>" . LotacaoController::getNomeOrDesc($dataForm[$k]) . "</i></strong><br>";
                            array_push($diferencas, $alteracoes);
                            $redirectHistorico = "lotacao";
                            break;
                        default:
                            $alteracoes = "Alteração do campo " . ucfirst(str_replace("_", " ", $k)) . " de: <i>" . json_decode($dadosBD[0], true)[$k] . "</i> para: <i><strong>" . $dataForm[$k] . "</i></strong><br>";
                            array_push($diferencas, $alteracoes);
                    }

                }
            }

        }

        $textDiff = "Informações Gerais do Servidor<br>";
        foreach ($diferencas as $d) {
            $textDiff .= $d;
        }

        // --------------------------------------------------------


        //faz o update dos dados
        $update = $servidor->find($idServidor)->update($dataForm);


        // --------------------- VERIFICA O TELEFONE ---------------------------------

        // se apagar os fones do form, apaga no BD
        if ($fone[0] == null) {
            $valida = Contato::where('id_servidor', $idServidor)->get();
            if (count($valida) != 0) {

                $delete = Contato::where('id_servidor', $idServidor)->delete();
                $textDiff .= "Telefones excluídos<br>";

            }
        } // se não apagar os telefones do form
        else {

            $verificaTelefone = Contato::where('id_servidor', $idServidor)->get();

            $foneBD = array();
            foreach (json_decode($verificaTelefone) as $f) {

                array_push($foneBD, $f->numero);

            }
            // se os fones do banco forem diferentes do form
            if ($fone != $foneBD) {

                $delete = Contato::where('id_servidor', $idServidor)->delete();

                if ($fone[0] != null) {

                    foreach ($fone as $f) {
                        $insertFone = DB::table('contatos')->insert(
                            ['id_servidor' => $idServidor,
                                'numero' => $f]
                        );

                    }

                }

                $textDiff .= "Alteração no <i>telefone</i><br>";

            }


            // -----------------------------------------------------------------

        }

        /*
         * Alteracao dos dependentes
        */

        $dep_qtd = count(collect($request->get('dep_nome')));
        $dep_nome = $request->get('dep_nome');
        $dep_parentesco = $request->get('dep_parentesco');
        $dep_nascimento = $request->get('dep_nascimento');
        $verificaDep = DB::table('dependentes')->where('id_servidor', $idServidor)->get();

        // se apagar os dados do BD
        if ($dep_nome[0] == null) {
            if (count($verificaDep) != 0) {
                $deleteDep = DB::table('dependentes')->where('id_servidor', $idServidor)->delete();
                $textDiff .= "Dependentes excluídos<br>";
            }
        } else {

            $depBD = array();
            foreach (json_decode($verificaDep) as $dep) {
                array_push($depBD, $dep->nome);
            }
            // compara os nomes dos dependentes
            if ($dep_nome != $depBD) {
                $deleteDep = DB::table('dependentes')->where('id_servidor', $idServidor)->delete();
                for ($x = 0; $x < $dep_qtd; $x++) {
                    $insertDependente = DB::table('dependentes')->insert([
                        'id_servidor' => $idServidor,
                        'nome' => $dep_nome[$x],
                        'parentesco' => $dep_parentesco[$x],
                        'data_nascimento' => Tdata::TdataMysql($dep_nascimento[$x])
                    ]);
                }
                $textDiff .= "Alteração nos <i>Dependentes</i><br>";
            }
        }
        // ------------------------------------------------------------------- //

        // ----------------- alteracao dos cursos ----------------------------- //
        $verificaCursos = DB::table('cursos_superiores')->where('id_servidor', $idServidor)->get();


        $cursos = $request->get('cursos');
        if ($cursos == null) {

            $deleteCursos = DB::table('cursos_superiores')->where('id_servidor', $idServidor)->delete();
            $textDiff .= "Cursos superiores excluídos<br>";

        } else {
            $cursosBD = array();
            foreach (json_decode($verificaCursos) as $cur) {
                array_push($cursosBD, $cur->curso);
            }

            if ($cursos != $cursosBD) {
                $deleteCursos = DB::table('cursos_superiores')->where('id_servidor', $idServidor)->delete();

                foreach ($cursos as $curso => $c) {
                    $insertCursoSuperior = DB::table('cursos_superiores')->insert([
                        'id_servidor' => $idServidor,
                        'curso' => $c,
                        'created_at' => Tdata::TdataHojeMysql()
                    ]);

                }
                $textDiff .= "Alteração nos<i> Cursos Superiores</i><br>";
            }
        }

        // ----------------- !alteracao dos cursos ----------------------------- //

        if ($request->hasFile('inputFile')) {

            $image = $request->file('inputFile');

            // faz a validação da imagem
            $extensions = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'PNG');
            if (!in_array($image->getClientOriginalExtension(), $extensions)) {
                return redirect()->back()->withInput()->with('alert-danger', 'O tipo do arquivo que você está tentando enviar não é permitido! Envie apenas arquivos com as extensões: jpg, jpeg ou png.');
            }

            $destinationPath = Constantes::ARVQUIVOS_SERVIDORES . "/" . $idServidor . "/foto";

            $name = $idServidor . '.' . $image->getClientOriginalExtension();

            $textDiff .= "Alteração na <i>foto</i>";

            $image->storeAs($destinationPath, $name);
        }

        if (!empty($textDiff)) {
            LogServidorController::addLog($idServidor, $textDiff);
        }

        if ($update) {
            if ($redirectHistorico == "lotacao") {
                return redirect()->route('servidor.historico', ['id' => $idServidor])->with('alert-warning', 'Cadastro alterado com sucesso! <br><strong>Cadastre no historico a remoção do servidor!</strong>');
            } else {

                return redirect('home')->with('alert-success', 'Cadastro alterado com sucesso!');
            }

        } else {

            return redirect('servidor_cadastro')->with('alert-danger', 'Ocorreu um problema ao salvar o formulário, por favor, tente novamente');


        }


    }

    public function funcional($id)
    {

        return view("servidor.funcional");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servidor $servidor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servidor $servidor)
    {
        //
    }

    /**
     * faz a busca dos servidores - requisição via ajax
     *
     */
    public function search(Request $request)
    {

        /**
         *  Seta todos os filtros da pesquisa
         */
        $nome = $request->input('nome');
        $matricula = $request->input('matricula');
        $lotacao = $request->input('lotacao');
        $sexo = $request->input('sexo');

        $pagina = substr($request->input('pagina'), 7);

        // quantidade de dados que vão ser pulados
        $skip = $request->input('skip');

        // limita a quantidade de dados que serao impressos na tela
        $limit = 10;

        // se for vazio(primeira requisição) assume o valor de 0
        if (empty($skip)) {

            $skip = 0;

        } else {

            if ($request->input('pagina') != "btnPesquisar") {

                $skip = ($pagina * $limit) - $limit;
            }

        }


        // define a tabela
        $query = DB::table('servidors');
        /**
         *  -------- IMPORTANTE! -----------
         *  para adicionar mais filtros para pesquisa, tem que colocar
         *  o name do campo dentro do array abaixo
         */
        $campos = array('nome', 'matricula', 'lotacao', 'sexo');
        foreach ($campos as $campo) {
            // verifica se o campo exite e se é vazio
            if (isset($$campo) && !empty($$campo)) {
                // create a new condition
                $query = $query->where($campo, 'LIKE', '%' . $$campo . '%');
            }
        }

        // total da pesquisa sem o skip e limit - utilizado para o calculo da paginação
        $totalPesquisa = $query->get();
        // armazena os dados dos servidores
        $servidores = $query->orderBy('nome', 'asc')->skip($skip)->limit($limit)->get();


        $qtdPesquisa = count($totalPesquisa);

        // cria o array com os dados que retornaram da pesquisa
        $dados = array();
        foreach ($servidores as $servidor) {

            array_push($dados, array(
                "id" => $servidor->id,
                "nome" => $servidor->nome,
                "matricula" => $servidor->matricula,
                "lotacao" => LotacaoController::getNomeOrDesc($servidor->lotacao)
            ));

        }


        // calcula o proximo skip
        if ($qtdPesquisa > $limit) {

            $data['retornoSkip'] = $skip + $limit;

        } else {
            $data['retornoSkip'] = 0;
        }

        //calcula a quantidade de páginas
        $paginas = $qtdPesquisa / $limit;

        $data['paginas'] = ceil($paginas);


        $data['retornoQtdImagem'] = $limit;

        $data['dadosServidores'] = $dados;

        return json_encode($data);


    }

    public function logEdit(Servidor $servidor, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = $servidor->find($id);
        $dadosView = json_encode($servidor);

        $dadosBDLog = DB::table('logaltservidors')
            ->where('id_servidor', $id)
            ->orderBy('data', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        $logServidor = array();

        foreach ($dadosBDLog as $d) {

            array_push($logServidor, array(
                "data" => Tdata::TdataBR($d->data),
                "hora" => $d->hora,
                "usuario" => $d->nome_usuario . " (" . $d->matricula_usuario . ")",
                "texto" => $d->texto
            ));

        }

        json_encode($logServidor);
        return view('servidor.log_servidor', compact('dadosView', 'foto', 'logServidor'));
    }

    /**
     * *****
     *  Faz a listagem e o filtro do historico
     * *****
     * @param Servidor $servidor
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function historico(Servidor $servidor, Request $request, $id)
    {

// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = $servidor->find($id);
        $dadosView = json_encode($servidor);

        $historicoFiltros = DB::table('historico_filtros')->where('status', 1)->orderBy('nome', 'ASC')->get();
        json_encode($historicoFiltros);

        // se passar um parametro para o filtro
        $filtro = $request->get('selectFiltros');
        if (!empty($filtro)) {
            // se o filtro for igual a "exibir todos" (setado no value do select o valor de 0)
            if ($filtro == 0) {
                $historicoDadosDB = DB::table('historico')->where('status', 1)->where('id_servidor', $id)->orderBy('data_inicio', 'DESC')->get();
            } else {
                $historicoDadosDB = DB::table('historico')->where('id_servidor', $id)->where('tipo', $filtro)->orWhere('status', 1)->where('status', "R")->orderBy('data_inicio', 'DESC')->get();
            }

        } else {
            $historicoDadosDB = DB::table('historico')->where('id_servidor', $id)->where('status', 1)->orderBy('data_inicio', 'DESC')->get();

        }


        $dadosArquivo = array();
        $historicoArquivosDB = DB::table('historico_arquivos')->get();

        foreach ($historicoArquivosDB as $ha) {

            array_push($dadosArquivo, array(
                "id" => $ha->id,
                "id_historico" => $ha->id_historico,
                "arquivo" => $ha->arquivo
            ));


        }

        $dadosHistorico = array();

        foreach ($historicoDadosDB as $dh) {

            ($dh->duracao > 1) ? $dia = "dias" : $dia = "dia";
            switch ($dh->tipo) {
                // tipo for "atestado"
                case 1:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo);
                    break;
                // tipo for "afastamento"
                case 5:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "outros"
                case 6:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "licencas"
                case 7:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "concessoes"
                case 8:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "ferias"
                case 9:

                    if ($dh->data_inicio == $dh->data_final) {
                        $tipo = " - Férias não gozadas";
                    } else {

                        $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . Tdata::getMesExt($dh->mes) . "/" . $dh->ano;

                    }
                    break;
                // tipo for "penalidade"
                case 10:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "remocoes"
                case 11:
                    $tipo = " - " . HistoricoController::getNome($dh->tipo) . " - " . LotacaoController::getNomeOrDesc($dh->titulo);
                    break;
                default:
                    $tipo = " - " . HistoricoController::getNome($dh->tipo);
            }

            array_push($dadosHistorico, array(
                "id" => $dh->id,
                "tipo" => $tipo,
                "id_tipo" => $dh->tipo,
                "descricao" => $dh->descricao,
                "status" => $dh->status,
                "data" => Tdata::TdataBR(substr($dh->data_inicio, 0, 10)),

            ));

        }

        $anos = array(Tdata::ano() - 1, Tdata::ano(), Tdata::ano() + 1, Tdata::ano() + 2);
        $licencas = Tstring::licencas();
        $afastamentos = Tstring::afastamentos();
        $penalidades = Tstring::penalidades();
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();

        json_encode($dadosHistorico);
        json_encode($dadosArquivo);
        json_encode($anos);
        json_encode($licencas);
        json_encode($afastamentos);
        json_encode($lotacao);

        return view('servidor.historico', compact('dadosView', 'foto', 'historicoFiltros', 'dadosHistorico', 'dadosArquivo', 'anos', 'licencas', 'afastamentos', 'penalidades', 'lotacao'));
    }

    /**
     * ******
     *  Insere no BD um novo evento no historico
     * ******
     * @param Request $request
     * @param Historico $historico
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function historicoStore(Request $request, Historico $historico, $id)
    {

        $dataForm = $request->except('_token', 'inputFile', 'tipoLicenca', 'tipo_afastamento', 'tipo_concessao', 'tipoPenalidade', 'lotacao');
        $dataForm['id_servidor'] = $id;

        // se o tipo do evento for Afastamento, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 5) {
            $dataForm['titulo'] = $request->get('tipo_afastamento');
        }

        // se o tipo do evento for licenca, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 7) {
            $dataForm['titulo'] = $request->get('tipoLicenca');
        }

        // se o tipo do evento for concessoes, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 8) {
            $dataForm['titulo'] = $request->get('tipo_concessao');
        }

        // se o tipo do evento for penalidade, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 10) {
            $dataForm['titulo'] = $request->get('tipoPenalidade');
        }

        // se o tipo do evento for remocao, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 11) {
            $dataForm['titulo'] = $request->get('lotacao');
        }

        // se o o evento tiver data de início e fim registrada, calcula a duracao
        if ($dataForm['tipo'] == 5 || $dataForm['tipo'] == 1 || $dataForm['tipo'] == 8 || $dataForm['tipo'] == 9 || $dataForm['tipo'] == 7 || $dataForm['tipo'] == 6 || $dataForm['tipo'] == 10) {

            if (Tdata::compDatas($request->get('data_inicio'), $request->get('data_final')) == "maior") {
                return redirect()->back()->withInput()->with('alert-danger', 'Data inicial não pode ser maior que data final');
            }

            $dataForm['data_inicio'] = Tdata::TdataMysql($dataForm['data_inicio']);
            $dataForm['data_final'] = Tdata::TdataMysql($dataForm['data_final']);

            $dataForm['duracao'] = Tdata::diffDate(Tdata::TdataMysql($request->get('data_inicio')), Tdata::TdataMysql($request->get('data_final')), "D") + 1;

        }else{
            $dataForm['data_inicio'] = Tdata::TdataMysql($dataForm['data_inicio']);
        }


        // ------------------- Validacoes ---------------------

        if ($dataForm['tipo'] == 0 || $dataForm['descricao'] == "" || $request->file('inputFile') == "") {
            return redirect()->back()->withInput()->with('alert-danger', 'Preencha todos os campos do formulário');
        }

        foreach ($request->file('inputFile') as $verify) {
            if (strtolower(substr($verify->getClientoriginalName(), -4)) != ".pdf" && strtolower(substr($verify->getClientoriginalName(), -4)) != ".jpg" && strtolower(substr($verify->getClientoriginalName(), -4)) != ".png") {
                return redirect()->back()->withInput()->with('alert-danger', 'Selecione apenas arquivos com a extensão .pdf, .jpg ou .png');
            }
        }
        // ------------------------------------------------------


        // faz o cadastro no banco
        $idHistorico = $historico->create($dataForm)->id;

        if ($request->hasFile('inputFile')) {

            $files = $request->file('inputFile');


            foreach ($files as $file) {

                $destinationPath = Constantes::ARVQUIVOS_SERVIDORES . "/" . $id;

                $name = $id . "_" . time() . "_" . $file->getClientOriginalName();

                $file->storeAs($destinationPath, $name);

                $insert = DB::table('historico_arquivos')->insert(
                    ['id_historico' => $idHistorico,
                        'arquivo' => $name
                    ]
                );

            }
        }

        $textLog = "Histórico do Servidor<br>Evento <strong>" . HistoricoController::getNome($dataForm['tipo']) . "</strong> adicionado no histórico do servidor";
        if ($idHistorico) {
            LogServidorController::addLog($id, $textLog);
            return redirect()->route('servidor.historico', ['id' => $id])->with('alert-success', 'Evento inserido com sucesso!');

        }

    }

    /**
     * ******
     *  Faz a visualizacao do documento
     * ******
     * @param $id
     * @param $id_servidor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function historicoView($id, $id_servidor)
    {

        $documento = DB::table('historico_arquivos')->where('id', $id)->get();

        // se o arquivo existir no servidor
        if (file_exists(storage_path('app/'.Constantes::ARVQUIVOS_SERVIDORES . "/" . $id_servidor . "/" . $documento[0]->arquivo))) {

            return response()->file(storage_path('app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id_servidor . "/" . $documento[0]->arquivo));
        } else {

            return redirect()->back()->with('alert-danger', 'Arquivo não encontrado!');

        }
    }

    /**
     * ******
     *  View de edicao de um evento do historico
     * ******
     * @param Historico $historico
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function historicoEdit(Historico $historico, $id)
    {

        $dadosView = $historico->find($id);

        json_decode($dadosView['data_inicio'], true);
        $dadosView['data_inicio'] = Tdata::TdataBR($dadosView['data_inicio']);
        $dadosView['data_final'] = Tdata::TdataBR($dadosView['data_final']);

        $historicoFiltros = DB::table('historico_filtros')->where('status', 1)->where('id', '!=', 9)->orderBy('nome', 'ASC')->get();
        json_encode($historicoFiltros);

        $arquivos = DB::table('historico_arquivos')->where('id_historico', json_decode($dadosView)->id)->get();
        $lotacao = DB::table('lotacaos')->orderBy('sigla', 'ASC')->get();

        $licencas = Tstring::licencas();
        $afastamentos = Tstring::afastamentos();
        $penalidades = Tstring::penalidades();

        json_encode($arquivos);
        json_encode($licencas);
        json_encode($afastamentos);
        json_encode($dadosView);
        json_encode($lotacao);

        return view('servidor.historico_alterar', compact('dadosView', 'historicoFiltros', 'arquivos', 'licencas', 'afastamentos', 'penalidades', 'lotacao'));

    }

    /**
     * ******
     *  Registra a edicao do evento no BD
     * ******
     * @param Request $request
     * @param Historico $historico
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function historicoUpdate(Request $request, Historico $historico, $id)
    {

        $dataForm = $request->except('_token', 'inputFile', 'tipoLicenca', 'tipo_afastamento', 'tipo_concessao', 'tipoPenalidade', 'lotacao');


        // se o tipo do evento for Afastamento, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 5) {
            $dataForm['titulo'] = $request->get('tipo_afastamento');
        }

        // se o tipo do evento for licenca, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 7) {
            $dataForm['titulo'] = $request->get('tipoLicenca');
        }

        // se o tipo do evento for concessoes, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 8) {
            $dataForm['titulo'] = $request->get('tipo_concessao');
        }

        // se o tipo do evento for penalidade, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 10) {
            $dataForm['titulo'] = $request->get('tipoPenalidade');
        }

        // se o tipo do evento for remocao, inclui o texto no campo titulo
        if ($dataForm['tipo'] == 11) {
            $dataForm['titulo'] = $request->get('lotacao');
        }


        // se o tipo do evento for atestado, calcula a duracao
        if ($dataForm['tipo'] == 1) {

            if (Tdata::compDatas($request->get('data_inicio'), $request->get('data_final')) == "maior") {
                return redirect()->back()->withInput()->with('alert-danger', 'Data inicial não pode ser maior que data final');
            }

            $dataForm['duracao'] = Tdata::diffDate(Tdata::TdataMysql($request->get('data_inicio')), Tdata::TdataMysql($request->get('data_final')), "D") + 1;

            $dataForm['data_inicio'] = Tdata::TdataMysql($dataForm['data_inicio']);
            $dataForm['data_final'] = Tdata::TdataMysql($dataForm['data_final']);
        }


        // ------------------- Validacoes ---------------------

        if ($dataForm['tipo'] == 0 || $dataForm['descricao'] == "") {
            return redirect()->back()->withInput()->with('alert-danger', 'Preencha todos os campos do formulário');
        }

        if (!empty($request->file('inputFile'))) {

            foreach ($request->file('inputFile') as $verify) {
                if (strtolower(substr($verify->getClientOriginalName(), -4)) != ".pdf") {
                    return redirect()->back()->withInput()->with('alert-danger', 'Selecione apenas arquivos com a extensão .pdf');
                }

            }
        }
        // ------------------------------------------------------


        // ---------------  Faz o log de alteracao de dados -----------------------------------------

        $dadosBD = $historico->where('id', $id)->get();
        json_decode($dadosBD[0]);

        $diferencas = array();

        foreach ($dataForm as $k => $v) {
            if ($dataForm[$k] != json_decode($dadosBD[0], true)[$k]) {

                if (empty($dataForm[$k])) {

                    $alteracoes = "Exclusão de dados do campo " . ucfirst(str_replace("_", " ", $k)) . ": <i><strong>" . $dataForm[$k] . "</i></strong><br>";
                    array_push($diferencas, $alteracoes);

                } else {

                    $alteracoes = "Inclusão de dados no campo " . ucfirst(str_replace("_", " ", $k)) . ": <i><strong>" . $dataForm[$k] . "</i></strong><br>";
                    array_push($diferencas, $alteracoes);
                }
            }

        }


        if ($request->hasFile('inputFile')) {

            $files = $request->file('inputFile');

            foreach ($files as $file) {

                $destinationPath = Constantes::ARVQUIVOS_SERVIDORES . "/" . json_decode($dadosBD[0], true)['id_servidor'];

                $name = json_decode($dadosBD[0], true)['id_servidor'] . "_" . time() . "_" . $file->getClientOriginalName();

                $file->storeAs($destinationPath, $name);

                $insert = DB::table('historico_arquivos')->insert(
                    ['id_historico' => $id,
                        'arquivo' => $name
                    ]
                );

                array_push($diferencas, "Inclusão do arquivo <strong>" . $name . "</strong> no histórico");

            }
        }


        $textDiff = "Histórico do Servidor<br>";
        foreach ($diferencas as $d) {
            $textDiff .= $d;
        }

        $dataForm['data_inicio'] = Tdata::TdataMysql($dataForm['data_inicio']);
        $dataForm['data_final'] = Tdata::TdataMysql($dataForm['data_final']);

        //faz o update dos dados
        $update = $historico->find($id)->update($dataForm);

        if (!empty($textDiff)) {
            LogServidorController::addLog(json_decode($dadosBD[0], true)['id_servidor'], $textDiff);
        }

        if ($update) {
            // return redirect()->route('home');
            return redirect()->route('servidor.historico', ['id' => json_decode($dadosBD[0], true)['id_servidor']])->with('alert-success', 'Evento Alterado com sucesso!');


        } else {

            return redirect()->back()->with('alert-danger', 'Ocorreu um problema ao salvar os dados, por favor, tente novamente mais tarde');

        }

    }

    /**
     * ******
     *  Revoga o Evento
     * ******
     * @param $id
     */
    public function historicoRevogar($id, $id_servidor)
    {

        $evento = DB::table('historico')->where('id', $id)->get();

        $text = "Histórico do Servidor<br>O evento <strong>" . HistoricoController::getNome(json_decode($evento)[0]->tipo) . " " . Tdata::getMesExt(json_decode($evento)[0]->mes) . "/" . json_decode($evento)[0]->ano . "</strong> foi revogado";


        $revogar = DB::table('historico')->where('id', $id)->update(['status' => 'R']);

        if ($revogar) {
            LogServidorController::addLog($id_servidor, $text);
            return redirect()->back()->with('alert-success', 'Evento revogado!');
        } else {
            return redirect()->back()->with('alert-danger', 'Não foi possível realizar as alterações!');
        }

    }

    public function historicoPrint(Request $request, Servidor $servidor, Lotacao $lotacao, $id){
        $servidor = $servidor->find($id);
        $servidor['lotacao'] = LotacaoController::getNomeOrDesc($servidor->lotacao);
        $servidor = json_encode($servidor);

        $historicoDadosDB = DB::table('historico')->where('id_servidor', $id)->where('status', 1)->orWhere('status', "R")->orderBy('data_inicio', 'DESC')->get();

        $dadosHistorico = array();
        foreach ($historicoDadosDB as $dh) {

            ($dh->duracao > 1) ? $dia = "dias" : $dia = "dia";
            switch ($dh->tipo) {
                // tipo for "atestado"
                case 1:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo);
                    break;
                // tipo for "afastamento"
                case 5:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "outros"
                case 6:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "licencas"
                case 7:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "concessoes"
                case 8:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "ferias"
                case 9:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . Tdata::getMesExt($dh->mes) . "/" . $dh->ano;
                    break;
                // tipo for "penalidade"
                case 10:
                    $tipo = " até " . Tdata::TdataBR($dh->data_final) . " (" . $dh->duracao . " " . $dia . ") - " . HistoricoController::getNome($dh->tipo) . " - " . $dh->titulo;
                    break;
                // tipo for "remocoes"
                case 11:
                    $tipo = " - " . HistoricoController::getNome($dh->tipo) . " - " . LotacaoController::getNomeOrDesc($dh->titulo);
                    break;
                default:
                    $tipo = " - " . HistoricoController::getNome($dh->tipo);
            }

            array_push($dadosHistorico, array(
                "id" => $dh->id,
                "tipo" => $tipo,
                "id_tipo" => $dh->tipo,
                "descricao" => $dh->descricao,
                "status" => $dh->status,
                "data" => Tdata::TdataBR(substr($dh->data_inicio, 0, 10)),
            ));

        }

        $lista = $request->get('listaSelecionada');
        $dadosHistorico = array_filter($dadosHistorico, function($item) use ($lista){
            return Util::contemNoArray( $item['id_tipo'], $lista);
        });

        json_encode($dadosHistorico);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Histórico";

        return view('servidor.historico_print', compact('dadosHistorico','servidor','menuNome','dataRelatorio'));
    }

    /**
     * ******
     *  Apaga um arquivo do evento
     * ******
     * @param $id
     * @param $id_historico
     * @param $id_servidor
     * @return \Illuminate\Http\RedirectResponse
     */
    public function historicoDeleteFile($id, $id_historico, $id_servidor)
    {
        $dadosBD = DB::table('historico_arquivos')->where('id_historico', $id_historico)->get();


        // se houver apenas um arquivo
        if (count($dadosBD) <= 1) {

            $inativar = DB::table('historico')->where('id', $id_historico)->update(['status' => '0']);

            if ($inativar) {
                return redirect()->route('servidor.historico', ['id' => $id_servidor])->with('alert-success', 'Evento Deletado com sucesso!');

            }

        } else {

            $arquivo = DB::table('historico_arquivos')->where('id', $id)->get();


            $move = Storage::move(Constantes::ARVQUIVOS_SERVIDORES . "/" . $id_servidor . "/" . json_decode($arquivo, true)[0]['arquivo'], Constantes::ARQUIVO_MORTO . "/" . json_decode($arquivo, true)[0]['arquivo']);

            LogServidorController::addLog($id_servidor, "Exclusão no histórico do arquivo <strong>" . json_decode($arquivo, true)[0]['arquivo'] . "</strong>");

            $delete = DB::table('historico_arquivos')->where('id', $id)->delete();

            return redirect()->back()->with('alert-success', 'Arquivo deletado com sucesso!');


        }
    }

    public function documentos(Servidor $servidor, $id)
    {

        $servidor = $servidor->find($id);
        $dadosView = json_encode($servidor);
        $docs = DB::table('documentoservidors')->where('id_servidor', $id)->get();


// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        if (count($docs) > 0) {

            $documentos = array();

            foreach ($docs as $d) {

                array_push($documentos, array(
                    "arquivo" => $d->arquivo,
                    "titulo" => $d->titulo,
                    "data" => Tdata::TdataBR($d->data),
                    "id" => $d->id,
                ));

            }

            json_encode($documentos);

            return view('servidor.documentos', compact('dadosView', 'foto', 'documentos'));
        } else {

            $semDocumentos = "<strong><h3>Atenção!</h3></strong><br>Servidor sem documentos registrados.";

            return view('servidor.documentos', compact('dadosView', 'foto', 'semDocumentos'));

        }

    }

    public function documentosStore(Request $request, $id)
    {

        $titulo = $request->get('titulo');

        // ------------------- Validacoes ---------------------

        if ($titulo == "" || $request->file('inputFile') == "") {
            return redirect()->back()->with('alert-danger', 'Título e arquivo são obrigatórios');
        }

        foreach ($request->file('inputFile') as $verify) {
            if (strtolower(substr($verify->getClientoriginalName(), -4)) != ".pdf" && strtolower(substr($verify->getClientoriginalName(), -4)) != ".jpg" && strtolower(substr($verify->getClientoriginalName(), -4)) != ".png") {
                return redirect()->back()->withInput()->with('alert-danger', 'Selecione apenas arquivos com a extensão .pdf, .jpg ou .png');
            }
        }
        // -----------------------------------------------------

        if ($request->hasFile('inputFile')) {

            $files = $request->file('inputFile');

            foreach ($files as $file) {

                $destinationPath = Constantes::ARVQUIVOS_SERVIDORES . "/" . $id;

                $name = $id . "_" . time() . "_" . $file->getClientOriginalName();

                $file->storeAs($destinationPath, $name);

                $insert = DB::table('documentoservidors')->insert(
                    ['id_servidor' => $id,
                        'id_usuario' => Auth::user()->id,
                        'data' => Tdata::TdataHojeMysql(),
                        'hora' => Tdata::hora(),
                        'titulo' => $titulo,
                        'arquivo' => $name,
                    ]
                );

                $textoLog = "Documentos do Servidor<br>Inclusão do documento: <strong>" . $titulo . "</strong>";
                if ($insert) {
                    LogServidorController::addLog($id, $textoLog);
                } else {
                    return redirect()->route('servidor.documentos', ['id' => $id])->with('alert-danger', 'Falha na inserção de um arquivo!');
                }

            }
            return redirect()->route('servidor.documentos', ['id' => $id])->with('alert-success', 'Evento inserido com sucesso!');

        }

        // $textoLog = "Documentos do Servidor<br>Inclusão do documento: <strong>" . $titulo . "</strong>";
        //if($insert)
        //{
        //    LogServidorController::addLog($id, $textoLog);
        //     return redirect()->route('servidor.documentos', ['id' => $id])->with('alert-success', 'Evento inserido com sucesso!');
        // }
    }

    public function documentosView(Servidor $servidor, $id)
    {

        $documento = DB::table('documentoservidors')->where('id', $id)->get();
        // se o arquivo existir no servidor
        if (file_exists(storage_path('app/'.Constantes::ARVQUIVOS_SERVIDORES . "/" . $documento[0]->id_servidor . "/" . $documento[0]->arquivo))) {

            return response()->file(storage_path('app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $documento[0]->id_servidor . "/" . $documento[0]->arquivo));
        } else {
            return redirect()->back()->with('alert-danger', 'Arquivo não encontrado!');
        }
    }

    public function documentosDelete($id)
    {

        $documento = DB::table('documentoservidors')->where('id', $id)->get();

        if (file_exists(storage_path('app/'.Constantes::ARVQUIVOS_SERVIDORES . "/" . $documento[0]->id_servidor . "/" . $documento[0]->arquivo))) {
            $move = Storage::move(Constantes::ARVQUIVOS_SERVIDORES . "/" . $documento[0]->id_servidor . "/" . $documento[0]->arquivo, Constantes::ARQUIVO_MORTO . "/" . $documento[0]->arquivo);

            LogServidorController::addLog($documento[0]->id_servidor, "Documentos do Servidor<br>Exclusão do documento <strong>" . $documento[0]->arquivo . "</strong>");

            $delete = DB::table('documentoservidors')->where('id', $id)->delete();

            return redirect()->back()->with('alert-success', 'Arquivo deletado com sucesso!');

        } else {

            $delete = DB::table('documentoservidors')->where('id', $id)->delete();

            LogServidorController::addLog($documento[0]->id_servidor, "Documentos do Servidor<br>Exclusão do documento <strong>" . $documento[0]->arquivo . "</strong>");


        }

    }

    public function dadosFuncionais($id)
    {
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();
        
        //dd($servidor[0]);
       
        $servidor[0]->data_admissao_estado = Tdata::TdataBR($servidor[0]->data_admissao_estado);
        $servidor[0]->data_nomeacao = Tdata::TdataBR($servidor[0]->data_nomeacao);
        $servidor[0]->data_posse = Tdata::TdataBR($servidor[0]->data_posse);
        $servidor[0]->data_exercicio = Tdata::TdataBR($servidor[0]->data_exercicio);
        $servidor[0]->rg_data_expedicao = Tdata::TdataBR($servidor[0]->rg_data_expedicao);
        $servidor[0]->lotacao = LotacaoController::getNomeOrDesc($servidor[0]->lotacao, "sd");
        $servidor[0]->cargo = CargoController::getNome($servidor[0]->cargo);
        $servidor[0]->funcao = CargoController::getFuncao($servidor[0]->funcao);

        $dadosView = json_encode($servidor[0]);

// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------

        /**
         *  Carrega os dados de contato
         */
        $contatos = DB::table('contatos')->where('id_servidor', '=', $id)->get();
        $dadosContato = json_encode($contatos);

        $cursosRealizados = DB::table('cursos_superiores')->where("id_servidor", $id)->select('curso')->get();
        $cursos = "";
        foreach (json_decode($cursosRealizados, true) as $cursoReal => $cr) {
            $cursos .= $cr['curso'] . ", ";
        }

        return view('servidor.dados_funcionais', compact('dadosView', 'dadosContato', 'foto', 'cursos'));

    }


    public function dadosPessoais($id)
    {
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        //dd($dados[0]);
        $servidor[0]->data_nascimento = Tdata::TdataBR($servidor[0]->data_nascimento);
        $servidor[0]->rg_data_expedicao = Tdata::TdataBR($servidor[0]->rg_data_expedicao);
        $servidor[0]->data_admissao_estado = Tdata::TdataBR($servidor[0]->data_admissao_estado);
        $servidor[0]->data_nomeacao = Tdata::TdataBR($servidor[0]->data_nomeacao);
        $servidor[0]->data_posse = Tdata::TdataBR($servidor[0]->data_posse);

        $servidor[0]->residencia_estado = Tstring::nomeUf($servidor[0]->residencia_estado);
        $servidor[0]->naturalidade_uf = Tstring::nomeUf($servidor[0]->naturalidade_uf);
        $servidor[0]->rg_uf = Tstring::nomeUf($servidor[0]->rg_uf);
        $servidor[0]->titulo_eleitor_uf = Tstring::nomeUf($servidor[0]->titulo_eleitor_uf);

        $servidor[0]->lotacao = LotacaoController::getNomeOrDesc($servidor[0]->lotacao, "sd");
        //dd($teste);

        $dadosView = json_encode($servidor[0]);


// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        // dependentes
        $dependentes = DB::table('dependentes')->where('id_servidor', '=', $id)->select(DB::raw("DATE_FORMAT(data_nascimento,'%d/%m/%Y') as nascimento"), 'nome', 'parentesco')->get();


        return view('servidor.dados_pessoais', compact('dadosView', 'foto', 'dependentes'));

    }

    public function dadosFinanceiros($id)
    {
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);


// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------


        return view('servidor.dados_financeiros', compact('dadosView', 'foto'));

    }

    /**
     * Define o relatorio individual de atestados
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relAtestado(Request $request, $id)
    {

        // se houver foto cadastrada
        if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/" . $id . ".jpeg"))) {

            $foto = ('storage/app/'.Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/" . $id . ".jpeg");
            //$foto = str_replace("/","\\",$foto);
        } else {
            $foto = false;
        }

        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }


        $resultadoDB = $query->where('historico.tipo', 1)->select('servidors.nome','servidors.lotacao','servidors.matricula','historico.data_inicio', 'historico.data_final','historico.data_inicio', 'historico.data_final','historico.duracao')->orderBy('historico.data_inicio', 'DESC')->orderBy('historico.data_inicio', 'DESC')->get();


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

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Atestado";

        return view('servidor.relatorio.atestado.relatorio', compact('dadosView','id','foto', 'menuNome','resultado', 'dataRelatorio'));
    }

    /**
     * relatorio individual de afastamento
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relAfastamento(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        if ($request->get('tipo_afastamento') != "") {
            $query->where('historico.titulo', $request->get('tipo_afastamento'));
        }


        $resultadoDB = $query->where('historico.tipo', 5)->select('servidors.nome','servidors.lotacao','servidors.matricula','historico.data_inicio','historico.data_final','historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


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

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Afastamento";

        $afastamentos = Tstring::afastamentos();
        json_encode($afastamentos);

        return view('servidor.relatorio.afastamento.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio','afastamentos'));

    }

    /**
     * Relatorio individual de concessoes
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relConcessoes(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        if ($request->get('tipo_concessao') != "") {
            $query->where('historico.titulo', $request->get('tipo_concessao'));
        }


        $resultadoDB = $query->where('historico.tipo', 8)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


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

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Concessões";

        return view('servidor.relatorio.concessao.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    /**
     * Ralatorio individual de elogios
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relElogios(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 16)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "matricula" => $r['matricula']
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Elogios";

        return view('servidor.relatorio.elogio.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    /**
     * Relatorio individual de ferias
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relFerias(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 9)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Férias";

        return view('servidor.relatorio.ferias.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    /**
     * relatorio individual de licencas
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relLicencas(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        if ($request->get('tipoLicenca') != "") {
            $query->where('historico.titulo', $request->get('tipoLicenca'));
        }


        $resultadoDB = $query->where('historico.tipo', 7)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


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

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Licenças";

        $licencas = Tstring::licencas();
        json_encode($licencas);

        return view('servidor.relatorio.licenca.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio','licencas'));

    }

    /**
     * Relatorio individual de penalidade
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relPenalidades(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        if ($request->get('tipoPenalidade') != "") {
            $query->where('historico.titulo', $request->get('tipoPenalidade'));
        }


        $resultadoDB = $query->where('historico.tipo', 10)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


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

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Penalidades";

        $penalidades = Tstring::penalidades();
        json_encode($penalidades);


        return view('servidor.relatorio.penalidade.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio','penalidades'));

    }

    /**
     * relatorio individual de remocoes
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function relRemocoes(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 11)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
                "tipo" => LotacaoController::getNomeOrDesc($r['titulo']),
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Remoções";

        return view('servidor.relatorio.remocoes.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    public function relRedistribuicoes(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 12)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Redistribuições";

        return view('servidor.relatorio.redistribuicoes.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    public function relSubstituicoes(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 13)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Substituições";

        return view('servidor.relatorio.substituicoes.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    public function relVacancias(Request $request, $id)
    {
// -------------------------- FOTO -----------------------------------------------------------------------------------

        if (is_dir(storage_path('app/arquivos/servidores/' . $id . "/foto/"))) {

            $dir = storage_path('app/arquivos/servidores/' . $id . "/foto/");

            $b = scandir($dir, 1);

            // se houver foto cadastrada
            if (file_exists(storage_path('app/arquivos/servidores/' . $id . "/foto/" . $b[0]))) {

                $foto = ('storage/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $id . "/foto/" . $b[0]);
                //$foto = str_replace("/","\\",$foto);
            }

        } else {
            $foto = false;
        }
// -------------------------------------------------------------------------------------------------------------------
        $servidor = DB::table('servidors')->where('id', '=', $id)->get();

        $dadosView = json_encode($servidor[0]);

        $query = DB::table('historico');

        $query->join('servidors', 'servidors.id', '=', 'historico.id_servidor');

        $query->where('servidors.id', '=', $id);


        // se passar apenas data_inicio
        if (!empty($request->get('data_inicio'))) {
            $query->where('historico.data_inicio', '>=', TData::TdataMysql($request->get('data_inicio')));
        }

        // se passar apenas data_fim
        if (!empty($request->get('data_final'))) {
            $query->where('historico.data_final', '<=', TData::TdataMysql($request->get('data_final')));
        }

        $resultadoDB = $query->where('historico.tipo', 14)->select('servidors.nome', 'servidors.lotacao', 'servidors.matricula', 'historico.data_inicio', 'historico.data_final', 'historico.titulo')->orderBy('historico.data_inicio', 'DESC')->get();


        // cria o array com os dados que retornaram da pesquisa
        $resultado = array();
        foreach(json_decode($resultadoDB, true) as $r){


            array_push($resultado, array(
                "nome" => $r['nome'],
                "lotacao" => LotacaoController::getNomeOrDesc($r['lotacao']),
                "data_inicio" => Tdata::TdataBR($r['data_inicio']),
                "data_fim" => Tdata::TdataBR($r['data_final']),
            ));


        }

        json_encode($resultado);

        $dataRelatorio = Tdata::TdataHoje();

        $menuNome = "Vacâncias";

        return view('servidor.relatorio.vacancia.relatorio', compact('dadosView','id','foto','menuNome','resultado', 'dataRelatorio'));

    }

    public function webServiceFotosServidor($key, $cpfUser)
    {
        $keySiapen = "1wBd794bG5BFkHU71xltg6Gbo2Tx6a4y";

        $idServidor = DB::table('servidors')->where('cpf', $cpfUser)->select('id')->get();

        if ($keySiapen == $key) {
            if (is_dir(storage_path('app/arquivos/servidores/' . $idServidor[0]->id . "/foto/"))) {

                $dir = storage_path('app/arquivos/servidores/' . $idServidor[0]->id . "/foto/");

                $b = scandir($dir, 1);

                // se houver foto cadastrada
                if (file_exists(storage_path('app/arquivos/servidores/' . $idServidor[0]->id . "/foto/" . $b[0]))) {

                    $path = storage_path('/app/' . Constantes::ARVQUIVOS_SERVIDORES . "/" . $idServidor[0]->id . "/foto/" . $b[0]);
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $foto = 'data:image/' . $type . ';base64,' . base64_encode($data);
                }

            } else {

                $foto = null;
            }

            return $foto;

        }
    }
}
