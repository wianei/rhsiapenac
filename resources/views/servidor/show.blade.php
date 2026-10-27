@extends('theme.theme')

@section('content')

    <div class="divNavLinks">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="">Informações Gerais</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{  route('servidor.historico', json_decode($dadosView)[0]->id) }}">Histórico</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{  route('servidor.documentos', json_decode($dadosView)[0]->id) }}">Documentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{  route('servidor.logEdit', json_decode($dadosView)[0]->id) }}">
                    Log
                </a>
            </li>
        </ul>
    </div>

    @foreach(json_decode($dadosView) as $servidor)
        <h1 class="tituloSeccao">

            @if($foto != false)
                <img src="{{asset($foto)}}" height="100" alt="">
            @else
                <i class="fas fa-user-circle"></i>
            @endif

            {{$servidor->nome}}
            <a class="btn btn-primary float-right align-middle" id="btEditar"
               href="{{ route('servidor.editar', $servidor->id) }}" role="button"> <i class="fas fa-edit"></i> Editar</a>

        </h1>
    <hr>
        <script>
            function copyToClipboard(element) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(element).text()).select();
                document.execCommand("copy");
                $temp.remove();
            }
        </script>
        <ul class="ulMenuDados">
            <li class="liMenuShow" id="btnFiliacao"><i class="fa fa-group"></i> <div class="fontSize05em">Filiação</div></li>
            <li class="liMenuShow" id="btnEndereco"><i class="fa fa-map-marker"></i> <div class="fontSize05em">Endereço</div></li>
            <li class="liMenuShow" id="btnDadosPessoais"><i class="fa fa-user"></i> <div class="fontSize05em">Dados Pessoais</div></li>
            <li class="liMenuShow" id="btnContatos"><i class="fas fa-phone-square"></i> <div class="fontSize05em">Contatos</div></li>
            <li class="liMenuShow" id="btnDadosLotacao"><i class="fa fa-institution"></i> <div class="fontSize05em">Dados de Lotação</div></li>
            <li class="liMenuShow" id="btnInstrucao"><i class="fa fa-graduation-cap"></i> <div class="fontSize05em">Instrução</div></li>
            <li class="liMenuShow" id="btnDadosFinanceiros"><i class="fa fa-money"></i> <div class="fontSize05em">Dados Financeiros</div></li>
            <li class="liMenuShow" id="btnDependentes"><i class="fa fa-sitemap"></i> <div class="fontSize05em">Dependentes</div></li>
            <li class="liMenuShow" id="btnConjuge"><i class="fa fa-user"></i> <div class="fontSize05em">Cônjuge</div></li>
        </ul>
        <div class="fichaGlobal">

            <div id="divFiliacao">
                <h5><i class="fa fa-group"></i> Filiação</h5>
                <div class="row">
                    <div class="col"><strong>Pai: </strong>{{$servidor->pai}}</div>
                    <div class="col"><strong>Mãe: </strong>{{$servidor->mae}}</div>
                </div>
            </div>

            <div id="divEndereco">
                <h5><i class="fa fa-map-marker"></i> Endereço</h5>
                <div class="row">
                    <div class="col-6"><strong>Endereço: </strong>{{$servidor->residencia_logradouro}}</div>
                    <div class="col-3"><strong>Número: </strong>{{$servidor->residencia_numero}}</div>
                    <div class="col-3"><strong>Complemento: </strong>{{$servidor->residencia_complemento}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>Bairro: </strong>{{$servidor->residencia_bairro}}</div>
                    <div class="col-3"><strong>Cidade: </strong>{{$servidor->residencia_cidade}}</div>
                    <div class="col-3"><strong>Estado: </strong>{{$servidor->residencia_estado}}</div>
                    <div class="col-3"><strong>Cep: </strong>{{$servidor->residencia_cep}}</div>
                </div>
            </div>

            <div id="divDadosPessoais">
                <h5><i class="fa fa-user"></i> Dados Pessoais</h5>
                <div class="row">
                    <div class="col-3">
                        <strong class="float-left">Matrícula: </strong>

                        <div class="float-left ml-1" id="divMatricula"> {{$servidor->matricula}} </div>
                        <a href="#" title="Copiar Matricula" onclick="copyToClipboard('#divMatricula')"><i
                                    class="fas fa-copy cursorPointer ml-1"></i></a>
                    </div>
                    <div class="col-3"><strong>Sexo: </strong>{{$servidor->sexo}}</div>
                    <div class="col-3"><strong>Data de Nascimento: </strong>{{$servidor->data_nascimento}}</div>
                    <div class="col-3"><strong>Nível: </strong>{{$servidor->nivel}}</div>

                    <div class="col-3"><strong>Estado civil: </strong>{{$servidor->estado_civil}}(a)</div>
                    <div class="col-3"><strong>Nacionalidade: </strong>{{$servidor->nacionalidade}}</div>
                    <div class="col-3"><strong>Naturalidade cidade: </strong>{{$servidor->naturalidade_cidade}}</div>
                    <div class="col-3"><strong>Naturalidade Estado: </strong>{{$servidor->naturalidade_uf}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>CPF: </strong>{{$servidor->cpf}}</div>
                    <div class="col-3"><strong>RG: </strong>{{$servidor->rg_numero}}</div>
                    <div class="col-3"><strong>Orgão Expeditor: </strong>{{$servidor->rg_orgao}}</div>
                    <div class="col-3"><strong>Data Expedição RG: </strong>{{$servidor->rg_data_expedicao}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>UF RG: </strong>{{$servidor->rg_uf}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>CTPS Número: </strong>{{$servidor->carteira_trabalho_numero}}</div>
                    <div class="col-3"><strong>Série: </strong>{{$servidor->carteira_trabalho_serie}}</div>
                    <div class="col-3"><strong>UF: </strong>{{$servidor->carteira_trabalho_uf}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>Título de Eleitor: </strong>{{$servidor->titulo_eleitor_numero}}</div>
                    <div class="col-3"><strong>Zona: </strong>{{$servidor->titulo_eleitor_zona}}</div>
                    <div class="col-3"><strong>Secção: </strong>{{$servidor->titulo_eleitor_seccao}}</div>
                    <div class="col-3"><strong>Secção: </strong>{{$servidor->titulo_eleitor_seccao}}</div>
                    <div class="col-3"><strong>UF: </strong>{{$servidor->titulo_eleitor_uf}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>Certificado Militar: </strong>{{$servidor->certificado_militar}}</div>
                    <div class="col-3"><strong>PIS: </strong>{{$servidor->pis}}</div>
                    <div class="col-3"><strong>PASEP: </strong>{{$servidor->pasep}}</div>
                </div>
            </div>

            <div id="divContato">
                <h5><i class="fas fa-phone-square"></i> Contatos</h5>
                <div class="row">
                    @foreach(json_decode($dadosContato) as $contato)
                    <div class="col-6"><strong>Fone 0{{$loop->iteration}}: </strong>{{$contato->numero}}</div>
                    @endforeach
                </div>
            </div>

            <div id="divDadosLotacao">
                <h5><i class="fa fa-institution"></i> Dados de Lotação</h5>
                <div class="row">
                    <div class="col-3"><strong>Orgão de Vinculação: </strong>{{$servidor->orgao_vinculacao}}</div>
                    @if($servidor->orgao_vinculacao == "Outros")
                        <div class="col-6"><strong>Orgão de Vinculação: </strong> Outros - {{$servidor->orgao_vinculacao_outros}}</div>
                    @endif
                    <div class="col-3"><strong>Lotação no IAPEN AC: </strong>{{$servidor->lotacao}}</div>
                    <div class="col-3"><strong>Unidade: </strong>{{$servidor->unidade}}</div>
                    <div class="col-3"><strong>Quantidade de vínculo: </strong>{{$servidor->qtd_vinculo}}</div>
                    <div class="w-100"></div>
                    <div class="col-3"><strong>Carga horária: </strong>{{$servidor->carga_horaria}}</div>
                    <div class="col-3"><strong>Data de admissão no Estado: </strong>{{$servidor->data_admissao_estado}}</div>
                    <div class="col-3"><strong>Data de nomeção: </strong>{{$servidor->data_nomeacao}}</div>
                    <div class="col-3"><strong>Data da posse: </strong>{{$servidor->data_posse}}</div>
                    <div class="col-3"><strong>Situação: </strong>{{$servidor->situacao}}</div>
                </div>
            </div>

            <div id="divInstrucao">
                <h5><i class="fa fa-graduation-cap"></i> Instrução</h5>
                <div class="row">
                    <div class="col-3"><strong>Grau de Instrução: </strong>{{$servidor->grau_instucao}}</div>

                    @if(($cursos ) != "")
                        <div class="col-9"><strong>Curso superior: </strong>

                            {!! substr($cursos,0, -2) !!}

                        </div>
                    @endif

                </div>
            </div>

            <div id="divDadosFinanceiros">
                <h5><i class="fa fa-money"></i> Dados Financeiros</h5>
                <div class="row">
                    <div class="col-3"><strong>Banco: </strong>{{$servidor->banco}}</div>
                    <div class="col-3"><strong>Conta Corrente: </strong>{{$servidor->conta_corrente}}</div>
                    <div class="col-3"><strong>Agência Bancária: </strong>{{$servidor->agencia_bancaria}}</div>
                </div>
            </div>

            <div id="divDependentes">
                <h5><i class="fa fa-sitemap"></i> Dependentes</h5>
                <div class="row">
                    @foreach(json_decode($dependentes) as $dep)
                        <div class="col-6"><strong>Nome: </strong>{{$dep->nome}}</div>
                        <div class="col-3"><strong>Parentesco: </strong>{{$dep->parentesco}}</div>
                        <div class="col-3"><strong>Data de nascimento: </strong>{{$dep->nascimento}}</div>
                    @endforeach
                    <div class="col-6"><strong>Quantidade dependente Salário
                            Família: </strong>{{$servidor->dep_salario_familia}}</div>
                    <div class="col-6"><strong>Quantidade dependente IRRF: </strong>{{$servidor->dp_irrf}}</div>
                </div>
            </div>

            <div id="divConjuge">
                <h5><i class="fa fa-user"></i> Cônjuge</h5>
                <div class="row">
                    <div class="col-3"><strong>Cônjuge: </strong>{{$servidor->conjuge_nome}}</div>
                    <div class="col-3"><strong>Matricula: </strong>{{$servidor->conjuge_matricula}}</div>
                    <div class="col-3"><strong>Órgão: </strong>{{$servidor->conjuge_orgao}}</div>
                </div>
            </div>

        </div>
    @endforeach
@endsection
@push('css')
<link href="{{ asset('css/servidor_show.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/servidor_show.js') }}"></script>
@endpush