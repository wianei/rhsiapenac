@extends('theme.theme')

@section('content')

    @include('template._links_menu_servidor')

        <h1 class="tituloSeccao">
            @if($foto != false)
                <img src="{{url($foto)}}" height="100" alt="">
            @else
                <i class="fas fa-user-circle"></i>
            @endif

            {{json_decode($dadosView)->nome}}
            <a class="btn btn-primary float-right align-middle" id="btEditar"
               href="{{ route('servidor.editar', json_decode($dadosView)->id) }}" role="button"> <i class="fas fa-edit"></i> Editar</a>

        </h1>
        <hr>
        <div class="fichaGlobal">
            @php
                $dadosView = json_decode($dadosView);
            @endphp
            <div id="divDadosLotacao">
                <div class="row">
                    <div class="col-6 mt-3"><strong>Matrícula: </strong> {{$dadosView->matricula}}</div>
                    <div class="col-6 mt-3"><strong>Nível: </strong>{{$dadosView->nivel}}</div>
                    <div class="col-6 mt-3"><strong>Orgão de Vinculação: </strong>{{$dadosView->orgao_vinculacao}}</div>
                    @if($dadosView->orgao_vinculacao == "Outros")
                        <div class="col-6 mt-3"><strong>Orgão de Vinculação: </strong> Outros - {{$dadosView->orgao_vinculacao_outros}}</div>
                    @endif
                    <div class="col-6 mt-3"><strong>Lotação no IAPEN AC: </strong>{{$dadosView->lotacao}}</div>
                    <div class="col-6 mt-3"><strong>Cargo: </strong>{{$dadosView->cargo}}</div>
                    <div class="col-6 mt-3"><strong>Função: </strong>{{$dadosView->funcao}}</div>
                    <div class="col-6 mt-3"><strong>CPF: </strong>{{$dadosView->cpf}}</div>
                    <div class="col-6 mt-3"><strong>RG: </strong>{{$dadosView->rg_numero}}/{{$dadosView->rg_orgao}}/{{$dadosView->rg_uf}}</div>
                    <div class="col-6 mt-3"><strong>Data da Expedição do RG: </strong>{{$dadosView->rg_data_expedicao}}</div>
                    <div class="col-6 mt-3"><strong>Sexo: </strong>{{$dadosView->sexo}}</div>
                    <div class="col-6 mt-3"><strong>Quantidade de vínculos: </strong>{{$dadosView->qtd_vinculo}}</div>
                    <div class="col-6 mt-3"><strong>Carga horária: </strong>{{$dadosView->carga_horaria}}</div>
                    <div class="col-6 mt-3"><strong>Data de admissão no Estado: </strong>{{$dadosView->data_admissao_estado}}</div>
                    <div class="col-6 mt-3"><strong>Data de nomeção: </strong>{{$dadosView->data_nomeacao}}</div>
                    <div class="col-6 mt-3"><strong>Data da posse: </strong>{{$dadosView->data_posse}}</div>
                    <div class="col-6 mt-3"><strong>Data da entrada em exercício: </strong>{{$dadosView->data_exercicio}}</div>
                    <div class="col-6 mt-3"><strong>Situação: </strong>{{$dadosView->situacao}}</div>
                </div>
            </div>

            <div id="divContato">
                <h5><i class="fas fa-phone-square"></i> Contatos</h5>
                <div class="row">
                    <div class="col-6 mt-3"><strong>E-Mail: </strong>{{$dadosView->email}}</div>
                </div>
                <div class="row">
                    @foreach(json_decode($dadosContato) as $contato)
                        <div class="col-6 mt-3"><strong>Fone 0{{$loop->iteration}}: </strong>{{$contato->numero}}</div>
                    @endforeach
                </div>
            </div>
            <hr>
            <div id="divInstrucao">
                <h5><i class="fa fa-graduation-cap"></i> Instrução</h5>
                <div class="row">
                    <div class="col-6 mt-3"><strong>Grau de Instrução: </strong>{{$dadosView->grau_instucao}}</div>

                    @if(($cursos ) != "")
                        <div class="col-9"><strong>Curso superior: </strong>

                            {!! substr($cursos,0, -2) !!}

                        </div>
                    @endif

                </div>
            </div>
            <hr>

        </div>
@endsection
@push('css')
<link href="{{ asset('css/servidor_show.css') }}" rel="stylesheet">
@endpush
@push('script')
<script src="{{ asset('js/servidor_show.js') }}"></script>
@endpush